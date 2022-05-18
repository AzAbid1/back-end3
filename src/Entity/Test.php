<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPassed;

    /**
     * @ORM\OneToOne(targetEntity=Chapitre::class, inversedBy="test", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapitre;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="test", orphanRemoval=true)
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIsPassed(): ?bool
    {
        return $this->isPassed;
    }

    public function setIsPassed(?bool $isPassed): self
    {
        $this->isPassed = $isPassed;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(Chapitre $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setTest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTest() === $this) {
                $question->setTest(null);
            }
        }

        return $this;
    }

}
