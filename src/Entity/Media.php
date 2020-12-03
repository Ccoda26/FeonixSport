<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
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
    private $namePicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="media")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=Exercise::class, mappedBy="media")
     */
    private $exercises;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, mappedBy="media")
     */
    private $programs;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->exercises = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePicture(): ?string
    {
        return $this->namePicture;
    }

    public function setNamePicture(string $namePicture): self
    {
        $this->namePicture = $namePicture;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->Filename = $filename;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addMedium($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeMedium($this);
        }

        return $this;
    }

    /**
     * @return Collection|Exercise[]
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    public function addExercise(Exercise $exercise): self
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises[] = $exercise;
            $exercise->addMedium($this);
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercises->removeElement($exercise)) {
            $exercise->removeMedium($this);
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->addMedium($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->removeElement($program)) {
            $program->removeMedium($this);
        }

        return $this;
    }

}
