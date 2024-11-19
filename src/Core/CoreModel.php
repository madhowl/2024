<?php
namespace App\Core;
use App\Core\Interfaces\ModelInterface;
use PDO;

abstract class CoreModel implements ModelInterface
{
    protected PDO $pdo;
    protected $table;
    public array $fields = [];
    public array $rules = [];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        //$this->setTable('articles');
    }

    public function setTable($table): void
    {
        $this->table = $table;
    }
    public function getAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table );
        $stmt->execute([]);
        return $stmt->fetchAll();
    }

    public function find($id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE id = :id');
        $stmt->execute([ 'id' => $id ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}