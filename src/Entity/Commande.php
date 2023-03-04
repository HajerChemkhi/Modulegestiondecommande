<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Range;



#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"dateCommande is required")]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;
    #[Assert\NotBlank(message:"total is required")]
    #[ORM\Column]
   
    #[Range(
        min: 0.0,
        max: 100000.0,
        notInRangeMessage: "La total doit être compris entre {{ min }} et {{ max }}.",
        invalidMessage: "Veuillez saisir un nombre décimal valide pour la total."
    )]
    private ?float $total = null;

    #[Assert\NotBlank(message:"prixLivraison is required")]
    
    #[ORM\Column]
    #[Range(
        min: 0.0,
        max: 100000.0,
        notInRangeMessage: "Le prix de livraison doit être compris entre {{ min }} et {{ max }}.",
        invalidMessage: "Veuillez saisir un nombre décimal valide pour le prix de livraison."
    )]
    private ?float $prixLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')
    
    
    ]
    #[Assert\NotBlank(message:"etatCommande is required")]
    private ?EtatCommande $etatCommande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPrixLivraison(): ?float
    {
        return $this->prixLivraison;
    }

    public function setPrixLivraison(float $prixLivraison): self
    {
        $this->prixLivraison = $prixLivraison;

        return $this;
    }

    public function getEtatCommande(): ?EtatCommande
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?EtatCommande $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }
}
