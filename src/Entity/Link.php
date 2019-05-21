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
     * @ORM\Column(type="string", length=100)
     */
    private $shorturl;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $Protocol;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $sufix;


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

    public function getProtocol(): ?string
    {
        return $this->Protocol;
    }

    public function setProtocol(?string $Protocol): self
    {
        $this->Protocol = $Protocol;

        return $this;
    }

    public function getSufix(): ?string
    {
        return $this->sufix;
    }

    public function setSufix(?string $sufix): self
    {
        $this->sufix = $sufix;

        return $this;
    }

    public function addProtocol(): self
    {   
        $longURL = $this->getLongurl();
        if (substr($longURL, 0, 5) !== 'https' || substr($longURL, 0, 4) !== 'http'){       
             $this->setLongurl('https://'.$longURL);
             return $this;
        }
        return $this;    
    }

}
