<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEmp;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRet;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livres;
    public $entityManager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmp(): ?\DateTimeInterface
    {
        return $this->dateEmp;
    }

    public function setDateEmp(\DateTimeInterface $dateEmp): self
    {
        $this->dateEmp = $dateEmp;

        return $this;
    }

    public function getDateRet(): ?\DateTimeInterface
    {
        return $this->dateRet;
    }

    public function setDateRet(\DateTimeInterface $dateRet): self
    {
        $this->dateRet = $dateRet;

        return $this;
    }



    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getLivres(): ?Livre
    {
        return $this->livres;
    }

    public function setLivres(?Livre $livres): self
    {
        $this->livres = $livres;

        return $this;
    }
}
