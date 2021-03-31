<?php
namespace App\Repository;

use App\Repository\Contracts\RepositoryInterface;
use App\Repository\Exception\ModelNotDefined;

abstract class BaseAbstractRepository implements RepositoryInterface
{
    protected $entity;
    public function __construct()
    {
        $this->entity = $this->resolver();
    }

    public function create(array $data)
    {
        return $this->entity->create($data);
    }
    public function findById(int $id)
    {
        return $this->entity->find($id);
    }

    public function findByUUID(string $uuid)
    {
        return $this->entity->Where('UUID', $uuid)->first();
    }

    public function withModels(array $models)
    {
        $this->entity = $this->entity->with($models);
    }

    public function resolver()
    {
        if (method_exists($this, 'model')) {
            $class = call_user_func([$this, 'model']);
            return new $class();
        }
        throw new ModelNotDefined("Add a method `model` to {$this} class");
    }
}
