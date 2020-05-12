<?php

namespace Laraditz\Repository;

class BaseRepository
{
    protected $model = null;

    protected $model_name = null;

    protected $model_path = 'App\\Models';

    public function __construct()
    {
        if ($this->model_name) {
            $model_path = config('repository.model_path')."\\".$this->model_name;
            
            if (class_exists($model_path)) {
                $this->setModel($model_path);
            }
        }        
    }

    private function setModel(String $model): void
    {
        $this->model = new $model;
    }

    public function getModel(): object
    {
        return $this->model;
    }

    public function getModelName(): string
    {
        return $this->model_name;
    }
}