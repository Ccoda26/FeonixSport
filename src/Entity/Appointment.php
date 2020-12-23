<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date;

    /**
     * @ORM\Column(type="time",nullable=true)
     */
    private $starthour;

    /**
     * @ORM\Column(type="time",nullable=true)
     */
    private $endHour;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dispo;

    /**
     * @ORM\Column(type="boolean",nullable=true )
     */
    private $reserver;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="appointments")
     */
    private $user;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getStarthour(): ?\DateTimeInterface
    {
        return $this->starthour;
    }

    public function setStarthour(\DateTimeInterface $starthour): self
    {
        $this->starthour = $starthour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->endHour;
    }

    public function setEndHour(\DateTimeInterface $endHour): self
    {
        $this->endHour = $endHour;

        return $this;
    }

    public function getDispo(): ?bool
    {
        return $this->dispo;
    }

    public function setDispo(bool $dispo): self
    {
        $this->dispo = $dispo;

        return $this;
    }

    public function getReserver(): ?bool
    {
        return $this->reserver;
    }

    public function setReserver(bool $reserver): self
    {
        $this->reserver = $reserver;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
