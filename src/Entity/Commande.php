<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommande::class, mappedBy="commande")
     */
    private $ligneCommandes;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $etatCommande;

    /**
     * @ORM\Column(type="smallint")
     */
    private $typeCommande;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurateur::class, inversedBy="commandesPassees")
     */
    private $restaurateurEmetteur;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurateur::class, inversedBy="commandesRecues")
     */
    private $restaurateurDestinataire;

    /**
     * @ORM\ManyToOne(targetEntity=Producteur::class, inversedBy="commandes")
     */
    private $producteur;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
    
    /**
     * @return Collection|LigneCommande[]
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getEtatCommande(): ?int
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(int $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getTypeCommande(): ?int
    {
        return $this->typeCommande;
    }

    public function setTypeCommande(int $typeCommande): self
    {
        $this->typeCommande = $typeCommande;

        return $this;
    }

    public function getRestaurateurEmetteur(): ?Restaurateur
    {
        return $this->restaurateurEmetteur;
    }

    public function setRestaurateurEmetteur(?Restaurateur $restaurateurEmetteur): self
    {
        $this->restaurateurEmetteur = $restaurateurEmetteur;

        return $this;
    }

    public function getRestaurateurDestinataire(): ?Restaurateur
    {
        return $this->restaurateurDestinataire;
    }

    public function setRestaurateurDestinataire(?Restaurateur $restaurateurDestinataire): self
    {
        $this->restaurateurDestinataire = $restaurateurDestinataire;

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
}
