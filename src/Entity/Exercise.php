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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Descritpion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="exercise")
     */
    private $Picture;

    public function __construct()
    {
        $this->Picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescritpion(): ?string
    {
        return $this->Descritpion;
    }

    public function setDescritpion(?string $Descritpion): self
    {
        $this->Descritpion = $Descritpion;

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
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->Picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->Picture->contains($picture)) {
            $this->Picture[] = $picture;
            $picture->setExercise($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->Picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getExercise() === $this) {
                $picture->setExercise(null);
            }
        }

        return $this;
    }


}
