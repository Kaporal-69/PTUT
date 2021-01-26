<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
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
     * @ORM\ManyToMany(targetEntity=producteur::class)
     */
    private $id_producteur;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieProduit::class, inversedBy="produits")
     */
    private $CategorieProduit;

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

    /**
     * @return Collection|producteur[]
     */
    public function getIdProducteur(): Collection
    {
        return $this->id_producteur;
    }

    public function addIdProducteur(producteur $idProducteur): self
    {
        if (!$this->id_producteur->contains($idProducteur)) {
            $this->id_producteur[] = $idProducteur;
        }

        return $this;
    }

    public function removeIdProducteur(producteur $idProducteur): self
    {
        $this->id_producteur->removeElement($idProducteur);

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
}
