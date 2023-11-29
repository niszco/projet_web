<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $name;

    #[ORM\ManyToMany(targetEntity: Shoes::class, inversedBy: 'sizes')]
    private Collection $shoes;

    #[ORM\ManyToMany(targetEntity: Clothes::class, mappedBy: 'size')]
    private Collection $clothes;

    public function __construct()
    {
        $this->shoes = new ArrayCollection();
        $this->clothes = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeShoe(Shoes $shoe): static
    {
        $this->shoes->removeElement($shoe);

        return $this;
    }

    /**
     * @return Collection<int, Clothes>
     */
    public function getClothes(): Collection
    {
        return $this->clothes;
    }

    public function addClothes(Clothes $clothes): static
    {
        if (!$this->clothes->contains($clothes)) {
            $this->clothes->add($clothes);
            $clothes->addSize($this);
        }

        return $this;
    }

    public function removeClothes(Clothes $clothes): static
    {
        if ($this->clothes->removeElement($clothes)) {
            $clothes->removeSize($this);
        }

        return $this;
    }
}
