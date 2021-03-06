<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     *
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     *
     * @Assert\Email(
     *     message="votre email {{ value }} n'est pas valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     * @Assert\Length (
     *     min="4",
     *     minMessage="Vote mot de pase doit contenir au moins 4 caractère",
     *      max="20",
     *      maxMessage=" votre mot de passe doit faire moins de 20 caractères"
     * )
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     *
     * * @Assert\Length(
     *     min="5",
     *     minMessage="Vérifier que votre code postale est correct",
     *     max="7",
     *     maxMessage="Vérifier que votre code postale est correct"
     * )
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )

     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *
     *  @Assert\NotBlank (
     *     message="ce champ ne peut pas ete vide"
     * )
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="user")
     */
    private $programs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min="8",
     *     minMessage="Vérifier que votre numéro est correct",
     *     max="12",
     *     maxMessage="Vérifier que votre numéro est correct"
     * )

     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="client")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity=Card::class, mappedBy="client")
     */
    private $userCard;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->userCard = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }


    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setClient($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getClient() === $this) {
                $booking->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getUserCard(): Collection
    {
        return $this->userCard;
    }

    public function addUserCard(Card $userCard): self
    {
        if (!$this->userCard->contains($userCard)) {
            $this->userCard[] = $userCard;
            $userCard->setClient($this);
        }

        return $this;
    }

    public function removeUserCard(Card $userCard): self
    {
        if ($this->userCard->removeElement($userCard)) {
            // set the owning side to null (unless already changed)
            if ($userCard->getClient() === $this) {
                $userCard->setClient(null);
            }
        }

        return $this;
    }



}
