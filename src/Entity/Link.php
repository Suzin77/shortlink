<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 */
class Link
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $longurl;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $shorturl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongurl(): ?string
    {
        return $this->longurl;
    }

    public function setLongurl(string $longurl): self
    {
        $this->longurl = $longurl;

        return $this;
    }

    public function getShorturl(): ?string
    {
        return $this->shorturl;
    }

    public function setShorturl(string $shorturl): self
    {
        $this->shorturl = $shorturl;

        return $this;
    }
}
