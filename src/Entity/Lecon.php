<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LeconRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LeconRepository::class)
 */
class Lecon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content_path;

    /**
     * @ORM\ManyToOne(targetEntity=Chapitre::class, inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapitre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContentPath(): ?string
    {
        return $this->content_path;
    }

    public function setContentPath(string $content_path): self
    {
        $this->content_path = $content_path;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(?Chapitre $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }
}
