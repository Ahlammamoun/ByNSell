<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
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
     * @ORM\OneToMany(targetEntity=Veste::class, mappedBy="brand")
     */
    private $vestes;

    public function __construct()
    {
        $this->vestes = new ArrayCollection();
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

    /**
     * @return Collection<int, Veste>
     */
    public function getVestes(): Collection
    {
        return $this->vestes;
    }

    public function addVeste(Veste $veste): self
    {
        if (!$this->vestes->contains($veste)) {
            $this->vestes[] = $veste;
            $veste->setBrand($this);
        }

        return $this;
    }

    public function removeVeste(Veste $veste): self
    {
        if ($this->vestes->removeElement($veste)) {
            // set the owning side to null (unless already changed)
            if ($veste->getBrand() === $this) {
                $veste->setBrand(null);
            }
        }

        return $this;
    }
}
