<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PlatRepository::class)
 * @ApiResource()
 */
class Plat
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
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurateur::class, inversedBy="plats")
     */
    private $restaurateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Allergies;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriePlat::class, inversedBy="plats")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRestaurateur(): ?Restaurateur
    {
        return $this->restaurateur;
    }

    public function setRestaurateur(?Restaurateur $restaurateur): self
    {
        $this->restaurateur = $restaurateur;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->Allergies;
    }

    public function setAllergies(string $Allergies): self
    {
        $this->Allergies = $Allergies;

        return $this;
    }

    public function getCategorie(): ?CategoriePlat
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriePlat $categorie): self
    {
        $this->categorie = $categorie;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
