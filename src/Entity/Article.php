<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
     * @Assert\NotBlank(
     *     message="Ce champs ne peut pas être vide"
     * )
     * @Assert\Length(
     *     min="5",
     *     minMessage="Votre titre est trop court",
     *     max="100",
     *     maxMessage="Votre titre est un peu trop long, essayez de le simplifier"
     * )
     *
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9\-\_\\,]+$/",
     *     message="le champs contient des caractères spéciaux"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     *  @Assert\NotBlank(
     *     message="Ce champs ne peut pas être vide"
     * )
     *
//     *  @Assert\Regex(
//     *     pattern="/^[a-zA-Z0-9\()\]+$/",
//     *     message="le champs contient des caractères spéciaux"
//     * )
     *
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
//     *  @Assert\Regex(
//     *     pattern="/^[a-zA-Z0-9\-\_\\,]+$/",
//     *     message="le champs contient des caractères spéciaux"
//     * )
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     *
     *  @Assert\NotBlank(
     *     message="Ce champs ne peut pas être vide"
     * )
     * @Assert\Type("Datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $published;

    /**
     * @ORM\ManyToMany(targetEntity=Picture::class, inversedBy="Articles", cascade="persist")
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate( $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): self
    {
        $this->published = $published;

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
