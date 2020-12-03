<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciseRepository::class)
 */
class Exercise
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
    private $nameExercise;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $exerciseDescritpion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity=media::class, inversedBy="exercises")
     */
    private $media;



    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameExercise(): ?string
    {
        return $this->nameExercise;
    }

    public function setNameExercise(string $nameExercise): self
    {
        $this->nameExercise = $nameExercise;

        return $this;
    }

    public function getExerciseDescritpion(): ?string
    {
        return $this->exerciseDescritpion;
    }

    public function setExerciseDescritpion(?string $exerciseDescritpion): self
    {
        $this->exerciseDescritpion = $exerciseDescritpion;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
        }

        return $this;
    }

    public function removeMedium(media $medium): self
    {
        $this->media->removeElement($medium);

        return $this;
    }


}
