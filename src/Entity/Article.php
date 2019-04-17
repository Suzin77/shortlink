<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type = "text")
     */
    private $title;

    /**
     * @ORM\Column(type = "text")
     */
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function getBody(){
        return $this->body;
    }



}
