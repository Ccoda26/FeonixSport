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
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;


    /**
     * @ORM\ManyToMany(targetEntity=Picture::class, inversedBy="exercises", cascade={"persist"}))
     */
    private $Filename;

    public function __construct()
    {

        $this->Filename = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $Description): self
    {
        $this->description = $Description;

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
    public function getFilename(): Collection
    {
        return $this->Filename;
    }

    public function addFilename(Picture $filename): self
    {
        if (!$this->Filename->contains($filename)) {
            $this->Filename[] = $filename;
        }

        return $this;
    }

    public function removeFilename(Picture $filename): self
    {
        $this->Filename->removeElement($filename);

        return $this;
    }
    

}
