<?php
namespace App\Core\Interfaces;
interface ModelInterface
{
    public function getAll(): mixed;

    public function find(int $id): mixed;


}