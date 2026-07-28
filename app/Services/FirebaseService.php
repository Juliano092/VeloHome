<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;
    protected $localProjectsFile;
    protected $localSalesFile;

    public function __construct()
    {
        $this->localProjectsFile = storage_path('app/projects_fallback.json');
        $this->localSalesFile = storage_path('app/sales_fallback.json');

        $factory = new Factory();
        $credentialsPath = env('FIREBASE_CREDENTIALS');
        $hasCredentials = false;

        if ($credentialsPath && file_exists(base_path($credentialsPath)) && is_file(base_path($credentialsPath))) {
            $factory = $factory->withServiceAccount(base_path($credentialsPath));
            $hasCredentials = true;
        } elseif ($credentialsPath && str_starts_with(trim($credentialsPath ?? ''), '{')) {
            $factory = $factory->withServiceAccount(json_decode($credentialsPath, true));
            $hasCredentials = true;
        } elseif (file_exists(base_path('firebase_credentials.json'))) {
            $factory = $factory->withServiceAccount(base_path('firebase_credentials.json'));
            $hasCredentials = true;
        }

        if (env('FIREBASE_DATABASE_URL')) {
            $factory = $factory->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        }

        if (env('APP_ENV') === 'local' || env('APP_ENV') == '') {
            $options = \Kreait\Firebase\Http\HttpClientOptions::default()->withGuzzleConfigOption('verify', false);
            $factory = $factory->withHttpClientOptions($options);
        }

        try {
            if ($hasCredentials && env('FIREBASE_DATABASE_URL')) {
                $this->database = $factory->createDatabase();
            } else {
                $this->database = null;
            }
        } catch (\Throwable $e) {
            $this->database = null;
        }
    }

    public function getProjectsReference()
    {
        return $this->database ? $this->database->getReference('projects') : null;
    }

    public function createProject(array $data)
    {
        $data['created_at'] = time();

        if ($this->database) {
            try {
                $reference = $this->getProjectsReference();
                if ($reference) {
                    $newProject = $reference->push($data);
                    return $newProject->getKey();
                }
            } catch (\Throwable $e) {
                // Fallback para arquivo local
            }
        }

        // Armazenamento local fallback
        $projects = $this->getLocalData($this->localProjectsFile);
        $id = 'local_' . uniqid();
        $data['id'] = $id;
        $projects[$id] = $data;
        $this->saveLocalData($this->localProjectsFile, $projects);

        return $id;
    }

    public function getAllProjects()
    {
        $projects = [];

        if ($this->database) {
            try {
                $reference = $this->getProjectsReference();
                if ($reference) {
                    $snapshot = $reference->getSnapshot();
                    if ($snapshot->hasChildren()) {
                        foreach ($snapshot->getValue() as $key => $projectData) {
                            $projects[] = array_merge(['id' => $key], $projectData);
                        }
                    }
                    usort($projects, function($a, $b) {
                        return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
                    });
                    return $projects;
                }
            } catch (\Throwable $e) {
                // Fallback para arquivo local
            }
        }

        $localProjects = $this->getLocalData($this->localProjectsFile);
        foreach ($localProjects as $key => $item) {
            $projects[] = array_merge(['id' => $key], $item);
        }

        usort($projects, function($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        return $projects;
    }

    public function getProjectById($id)
    {
        if ($this->database) {
            try {
                $reference = $this->getProjectsReference();
                if ($reference) {
                    $snapshot = $reference->getChild($id)->getSnapshot();
                    if ($snapshot->exists()) {
                        return array_merge(['id' => $id], $snapshot->getValue());
                    }
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localProjects = $this->getLocalData($this->localProjectsFile);
        if (isset($localProjects[$id])) {
            return array_merge(['id' => $id], $localProjects[$id]);
        }

        return null;
    }

    public function updateProject($id, array $data)
    {
        if ($this->database) {
            try {
                $reference = $this->getProjectsReference();
                if ($reference) {
                    $reference->getChild($id)->update($data);
                    return true;
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localProjects = $this->getLocalData($this->localProjectsFile);
        if (isset($localProjects[$id])) {
            $localProjects[$id] = array_merge($localProjects[$id], $data);
            $this->saveLocalData($this->localProjectsFile, $localProjects);
        }

        return true;
    }

    public function deleteProject($id)
    {
        if ($this->database) {
            try {
                $reference = $this->getProjectsReference();
                if ($reference) {
                    $reference->getChild($id)->remove();
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localProjects = $this->getLocalData($this->localProjectsFile);
        if (isset($localProjects[$id])) {
            unset($localProjects[$id]);
            $this->saveLocalData($this->localProjectsFile, $localProjects);
        }

        return true;
    }

    // ==========================================
    // VENDAS (SALES)
    // ==========================================

    public function getSalesReference()
    {
        return $this->database ? $this->database->getReference('sales') : null;
    }

    public function createSale(array $data)
    {
        $data['created_at'] = time();

        if ($this->database) {
            try {
                $reference = $this->getSalesReference();
                if ($reference) {
                    $newSale = $reference->push($data);
                    return $newSale->getKey();
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $sales = $this->getLocalData($this->localSalesFile);
        $id = 'local_' . uniqid();
        $data['id'] = $id;
        $sales[$id] = $data;
        $this->saveLocalData($this->localSalesFile, $sales);

        return $id;
    }

    public function getAllSales()
    {
        $sales = [];

        if ($this->database) {
            try {
                $reference = $this->getSalesReference();
                if ($reference) {
                    $snapshot = $reference->getSnapshot();
                    if ($snapshot->hasChildren()) {
                        foreach ($snapshot->getValue() as $key => $saleData) {
                            $sales[] = array_merge(['id' => $key], $saleData);
                        }
                    }
                    usort($sales, function($a, $b) {
                        return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
                    });
                    return $sales;
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localSales = $this->getLocalData($this->localSalesFile);
        foreach ($localSales as $key => $item) {
            $sales[] = array_merge(['id' => $key], $item);
        }

        usort($sales, function($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        return $sales;
    }

    public function updateSale($id, array $data)
    {
        if ($this->database) {
            try {
                $reference = $this->getSalesReference();
                if ($reference) {
                    $reference->getChild($id)->update($data);
                    return true;
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localSales = $this->getLocalData($this->localSalesFile);
        if (isset($localSales[$id])) {
            $localSales[$id] = array_merge($localSales[$id], $data);
            $this->saveLocalData($this->localSalesFile, $localSales);
        }

        return true;
    }

    public function deleteSale($id)
    {
        if ($this->database) {
            try {
                $reference = $this->getSalesReference();
                if ($reference) {
                    $reference->getChild($id)->remove();
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        $localSales = $this->getLocalData($this->localSalesFile);
        if (isset($localSales[$id])) {
            unset($localSales[$id]);
            $this->saveLocalData($this->localSalesFile, $localSales);
        }

        return true;
    }

    // Auxiliares para JSON local
    protected function getLocalData(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return [];
        }
        $content = file_get_contents($filePath);
        return json_decode($content, true) ?? [];
    }

    protected function saveLocalData(string $filePath, array $data): void
    {
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
