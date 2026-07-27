<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = new Factory();

        $credentialsPath = env('FIREBASE_CREDENTIALS');
        
        // Se for um arquivo existente, carrega pelo caminho. Se for uma string JSON, usa com ServiceAccount
        if ($credentialsPath && file_exists(base_path($credentialsPath)) && is_file(base_path($credentialsPath))) {
            $factory = $factory->withServiceAccount(base_path($credentialsPath));
        } elseif ($credentialsPath && str_starts_with(trim($credentialsPath), '{')) {
            $factory = $factory->withServiceAccount(json_decode($credentialsPath, true));
        } elseif (file_exists(base_path('firebase_credentials.json'))) {
            $factory = $factory->withServiceAccount(base_path('firebase_credentials.json'));
        }

        if (env('FIREBASE_DATABASE_URL')) {
            $factory = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        }

        // Se estiver em ambiente local (desenvolvimento) ou sem SSL verificado
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
     * Atualiza um projeto
     */
    public function updateProject($id, array $data)
    {
        $this->getProjectsReference()->getChild($id)->update($data);
        return true;
    }

    /**
     * Deleta um projeto
     */
    public function deleteProject($id)
    {
        $this->getProjectsReference()->getChild($id)->remove();
        return true;
    }

    // ==========================================
    // VENDAS (SALES)
    // ==========================================

    public function getSalesReference()
    {
        return $this->database->getReference('sales');
    }

    public function createSale(array $data)
    {
        $reference = $this->getSalesReference();
        $data['created_at'] = time();
        $newSale = $reference->push($data);

        return $newSale->getKey();
    }

    public function getAllSales()
    {
        $snapshot = $this->getSalesReference()->getSnapshot();
        $sales = [];

        if ($snapshot->hasChildren()) {
            foreach ($snapshot->getValue() as $key => $saleData) {
                $sales[] = array_merge(['id' => $key], $saleData);
            }
        }

        // Ordenar as mais recentes primeiro
        usort($sales, function($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        return $sales;
    }

    public function updateSale($id, array $data)
    {
        $this->getSalesReference()->getChild($id)->update($data);
        return true;
    }

    public function deleteSale($id)
    {
        $this->getSalesReference()->getChild($id)->remove();
        return true;
    }
}
