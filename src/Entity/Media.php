<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 64)]
    private ?string $altText = null;

    #[ORM\OneToMany(mappedBy: 'Image', targetEntity: Article::class)]
    private Collection $featured_image;

    public function __construct()
    {
        $this->featured_image = new ArrayCollection();
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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getAltText(): ?string
    {
        return $this->altText;
    }

    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getFeaturedImage(): Collection
    {
        return $this->featured_image;
    }

    public function addFeaturedImage(Article $featuredImage): self
    {
        if (!$this->featured_image->contains($featuredImage)) {
            $this->featured_image->add($featuredImage);
            $featuredImage->setImage($this);
        }

        return $this;
    }

    public function removeFeaturedImage(Article $featuredImage): self
    {
        if ($this->featured_image->removeElement($featuredImage)) {
            // set the owning side to null (unless already changed)
            if ($featuredImage->getImage() === $this) {
                $featuredImage->setImage(null);
            }
        }

        return $this;
    }
}
