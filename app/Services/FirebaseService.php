<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory())
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        // Se estiver em ambiente local (desenvolvimento), desativa a verificação SSL para evitar o erro cURL 60
        if (env('APP_ENV') === 'local' || env('APP_ENV') == '') {
            $options = \Kreait\Firebase\Http\HttpClientOptions::default()->withGuzzleConfigOption('verify', false);
            $factory = $factory->withHttpClientOptions($options);
        }

        $this->database = $factory->createDatabase();
    }

    /**
     * Retorna a referência da coleção de projetos no Realtime Database
     */
    public function getProjectsReference()
    {
        return $this->database->getReference('projects');
    }

    /**
     * Salva um novo projeto 3D no Firebase
     */
    public function createProject(array $data)
    {
        $reference = $this->getProjectsReference();
        
        $data['created_at'] = time();
        $newProject = $reference->push($data);

        return $newProject->getKey();
    }

    /**
     * Busca todos os projetos
     */
    public function getAllProjects()
    {
        $snapshot = $this->getProjectsReference()->getSnapshot();
        $projects = [];

        if ($snapshot->hasChildren()) {
            foreach ($snapshot->getValue() as $key => $projectData) {
                $projects[] = array_merge(['id' => $key], $projectData);
            }
        }

        // Ordenar os mais recentes primeiro
        usort($projects, function($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        return $projects;
    }

    /**
     * Busca um projeto específico pelo ID
     */
    public function getProjectById($id)
    {
        $snapshot = $this->getProjectsReference()->getChild($id)->getSnapshot();
        
        if ($snapshot->exists()) {
            return array_merge(['id' => $id], $snapshot->getValue());
        }

        return null;
    }

    /**
     * Deleta um projeto
     */
    public function deleteProject($id)
    {
        $this->getProjectsReference()->getChild($id)->remove();
        return true;
    }
}
