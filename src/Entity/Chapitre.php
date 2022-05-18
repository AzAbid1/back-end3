<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ChapitreRepository::class)
 */
class Chapitre
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCompleted;

    /**
     * @ORM\OneToMany(targetEntity=Lecon::class, mappedBy="chapitre")
     */
    private $lecons;

    /**
     * @ORM\OneToOne(targetEntity=Test::class, mappedBy="chapitre", cascade={"persist", "remove"})
     */
    private $test;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="chapitres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    public function __construct()
    {
        $this->lecons = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): self
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    /**
     * @return Collection<int, Lecon>
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    public function addLecon(Lecon $lecon): self
    {
        if (!$this->lecons->contains($lecon)) {
            $this->lecons[] = $lecon;
            $lecon->setChapitre($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->removeElement($lecon)) {
            // set the owning side to null (unless already changed)
            if ($lecon->getChapitre() === $this) {
                $lecon->setChapitre(null);
            }
        }

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(Test $test): self
    {
        // set the owning side of the relation if necessary
        if ($test->getChapitre() !== $this) {
            $test->setChapitre($this);
        }

        $this->test = $test;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
