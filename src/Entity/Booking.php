<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
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
    private $title;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     */
    private $client;


    /**
     * @ORM\ManyToMany(targetEntity=ChoiceDate::class, inversedBy="bookings",cascade={"persist"})
     */
    private $hourchoice;


    public function __construct()
    {
        $this->hourchoice = new ArrayCollection();
    }

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


    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|ChoiceDate[]
     */
    public function getHourchoice(): Collection
    {
        return $this->hourchoice;
    }

    public function addHourchoice(ChoiceDate $hourchoice): self
    {
        if (!$this->hourchoice->contains($hourchoice)) {
            $this->hourchoice[] = $hourchoice;
        }

        return $this;
    }

    public function removeHourchoice(ChoiceDate $hourchoice): self
    {
        $this->hourchoice->removeElement($hourchoice);

        return $this;
    }

}
