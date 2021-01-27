<?php

namespace App\Entity;

use App\Repository\RestaurateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurateurRepository::class)
 */
class Restaurateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity=Plat::class, mappedBy="restaurateur")
     */
    private $plats;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="retaurateur", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="restaurateurEmetteur")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="restaurateurEmetteur")
     */
    private $commandesPassees;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="restaurateurDestinataire")
     */
    private $commandesRecues;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->commandesPassees = new ArrayCollection();
        $this->commandesRecues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->setRestaurateur($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plats->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getRestaurateur() === $this) {
                $plat->setRestaurateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setRestaurateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getRestaurateur() === $this) {
                $commande->setRestaurateur(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setRetaurateur(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getRetaurateur() !== $this) {
            $user->setRetaurateur($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandesPassees(): Collection
    {
        return $this->commandesPassees;
    }

    public function addCommandesPassee(Commande $commandesPassee): self
    {
        if (!$this->commandesPassees->contains($commandesPassee)) {
            $this->commandesPassees[] = $commandesPassee;
            $commandesPassee->setRestaurateurEmetteur($this);
        }

        return $this;
    }

    public function removeCommandesPassee(Commande $commandesPassee): self
    {
        if ($this->commandesPassees->removeElement($commandesPassee)) {
            // set the owning side to null (unless already changed)
            if ($commandesPassee->getRestaurateurEmetteur() === $this) {
                $commandesPassee->setRestaurateurEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandesRecues(): Collection
    {
        return $this->commandesRecues;
    }

    public function addCommandesRecue(Commande $commandesRecue): self
    {
        if (!$this->commandesRecues->contains($commandesRecue)) {
            $this->commandesRecues[] = $commandesRecue;
            $commandesRecue->setRestaurateurDestinataire($this);
        }

        return $this;
    }

    public function removeCommandesRecue(Commande $commandesRecue): self
    {
        if ($this->commandesRecues->removeElement($commandesRecue)) {
            // set the owning side to null (unless already changed)
            if ($commandesRecue->getRestaurateurDestinataire() === $this) {
                $commandesRecue->setRestaurateurDestinataire(null);
            }
        }

        return $this;
    }
}
