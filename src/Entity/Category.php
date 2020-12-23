<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=Exercise::class, mappedBy="category")
     */
    private $Exercices;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="category")
     */
    private $Program;

    public function __construct()
    {
        $this->Exercices = new ArrayCollection();
        $this->Program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * @return Collection|Exercise[]
     */
    public function getExercices(): Collection
    {
        return $this->Exercices;
    }

    public function addExercice(Exercise $exercice): self
    {
        if (!$this->Exercices->contains($exercice)) {
            $this->Exercices[] = $exercice;
            $exercice->setCategory($this);
        }

        return $this;
    }

    public function removeExercice(Exercise $exercice): self
    {
        if ($this->Exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getCategory() === $this) {
                $exercice->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgram(): Collection
    {
        return $this->Program;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->Program->contains($program)) {
            $this->Program[] = $program;
            $program->setCategory($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->Program->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getCategory() === $this) {
                $program->setCategory(null);
            }
        }

        return $this;
    }
}
