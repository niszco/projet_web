<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Shoes::class)]
    private Collection $shoes;

    public function __construct()
    {
        $this->shoes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Shoes>
     */
    public function getShoes(): Collection
    {
        return $this->shoes;
    }

    public function addShoe(Shoes $shoe): static
    {
        if (!$this->shoes->contains($shoe)) {
            $this->shoes->add($shoe);
            $shoe->setBrands($this);
        }

        return $this;
    }

    public function removeShoe(Shoes $shoe): static
    {
        if ($this->shoes->removeElement($shoe)) {
            // set the owning side to null (unless already changed)
            if ($shoe->getBrands() === $this) {
                $shoe->setBrands(null);
            }
        }

        return $this;
    }
}
