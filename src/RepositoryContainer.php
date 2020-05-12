<?php

namespace Laraditz\Repository;

use Illuminate\Support\Str;

class RepositoryContainer
{
    /**
     * Magic method that return repository class.
     *
     * @param  string  $method
     * @param  string  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        $class_name = Str::studly($method).'Repository';
        $full_class_name = preg_replace_array('/:[a-z_]+/', [$class_name], 'App\\Repositories\\:class');

        if (class_exists($full_class_name)) {
            return new $full_class_name();
        }
    }
}
