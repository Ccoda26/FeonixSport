<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Filename;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="Filename")
     */
    private $Articles;

    /**
     * @ORM\ManyToMany(targetEntity=Exercise::class, mappedBy="Filename")
     */
    private $exercises;


    public function __construct()
    {

        $this->Articles = new ArrayCollection();
        $this->exercises = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->Articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->Articles->contains($article)) {
            $this->Articles[] = $article;
            $article->addFilename($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->Articles->removeElement($article)) {
            $article->removeFilename($this);
        }

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->Filename;
    }

    public function setFilename(?string $Filename): self
    {
        $this->Filename = $Filename;

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
            $exercise->addFilename($this);
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercises->removeElement($exercise)) {
            $exercise->removeFilename($this);
        }

        return $this;
    }

}
