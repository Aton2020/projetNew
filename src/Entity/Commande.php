<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private $date;

    #[ORM\Column(type: 'string', length: 255, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private ?string $adresse_livraison = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $code_postal;

    #[ORM\Column(type: 'string', length: 255, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $ville = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true, options:['collation' => 'utf8_general_ci'])]
    private $complement_adress;

    #[ORM\Column(type: 'float', nullable: false)]
    private $total = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private $paiement_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(string $adresse_livraison): self
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getComplementAdress(): ?string
    {
        return $this->complement_adress;
    }

    public function setComplementAdress(string $complement_adress): self
    {
        $this->complement_adress = $complement_adress;

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

    public function isPaiementStatus(): ?bool
    {
        return $this->paiement_status;
    }

    public function setPaiementStatus(bool $paiement_status): self
    {
        $this->paiement_status = $paiement_status;

        return $this;
    }
}
