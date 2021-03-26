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
     * @ORM\Column(type="datetime")
     */
    private $beginAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Paid;

    /**
     * @ORM\Column(type="float")
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
     * @return mixed
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * @param mixed $beginAt
     */
    public function setBeginAt($beginAt): void
    {
        $this->beginAt = $beginAt;
    }

    /**
     * @return mixed
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param mixed $endAt
     */
    public function setEndAt($endAt): void
    {
        $this->endAt = $endAt;
    }

    public function getPaid(): ?bool
    {
        return $this->Paid;
    }

    public function setPaid(?bool $Paid): self
    {
        $this->Paid = $Paid;

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
