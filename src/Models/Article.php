<?php

namespace App\Models;

use App\Core\CoreModel;
use App\Core\Interfaces\ModelInterface;
use PDO;
use App\Core\Helper as h;

class Article extends CoreModel implements ModelInterface
{
    public array $fields
        = [
            'id',
            'title',
            'image',
            'content',

        ];

    public array $rules
        = [
//        'id'             => 'required',
            'title'   => 'required',
            'image'   => 'required',
            'content' => 'required',

        ];

    public array $filter
        = [
            'id'      => 'whole_number',
            'title'   => 'trim|htmlencode',
            'image'   => 'trim|htmlencode',
            'content' => 'trim|basic_tags',

        ];

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->setTable('articles');
    }

    public function store( $article): void
    {
        $sql = "INSERT INTO ".$this->table." (id, title, image, content) VALUES (NULL, :title, :image, :content);" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":title", $article['title'], \PDO::PARAM_STR);
        $stmt->bindValue(":image", $article['image'], \PDO::PARAM_STR);
        $stmt->bindValue(":content", $article['content'], \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(object|array|null $article)
    {
        $sql = "INSERT INTO ".$this->table." (id, title, image, content) VALUES (NULL, :title, :image, :content)";
         $sql = "UPDATE ".$this->table." SET title = :title, image = :image, content = :content  WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $article['id'], \PDO::PARAM_INT);
        $stmt->bindValue(":title", $article['title'], \PDO::PARAM_STR);
        $stmt->bindValue(":image", $article['image'], \PDO::PARAM_STR);
        $stmt->bindValue(":content", $article['content'], \PDO::PARAM_STR);
        $stmt->execute();
    }


}