<?php
namespace App\Repository\Contracts;

interface RepositoryInterface
{
    public function model();
    public function create(array $data);
    public function findById(int $id);
    public function findByUUID(string $uuid);
    public function withModels(array $models);
}
