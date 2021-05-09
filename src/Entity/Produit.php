<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ApiResource()
 */
class Produit
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
     * @ORM\ManyToOne(targetEntity=CategorieProduit::class, inversedBy="produits")
     */
    private $CategorieProduit;

    /**
     * @ORM\ManyToOne(targetEntity=Producteur::class, inversedBy="produits")
     */
    private $producteur;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function __construct()
    {
        $this->id_producteur = new ArrayCollection();
    }

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

    public function getCategorieProduit(): ?CategorieProduit
    {
        return $this->CategorieProduit;
    }

    public function setCategorieProduit(?CategorieProduit $CategorieProduit): self
    {
        $this->CategorieProduit = $CategorieProduit;

        return $this;
    }

    public function getProducteur(): ?Producteur
    {
        return $this->producteur;
    }

    public function setProducteur(?Producteur $producteur): self
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
