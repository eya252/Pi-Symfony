<?php

namespace App\Entity;

use App\Repository\ParticiperRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ParticiperRepository::class)
 */
class Participer
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
    private $emplacement;

    /**
     * @Assert\Range(
     *      min = 2,
     *      max = 15,
     *      notInRangeMessage = "You must be between {{ min }} and {{ max }} number to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $nbrePlace;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="id")
     * })
     */
    private $idEvent;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getNbrePlace(): ?int
    {
        return $this->nbrePlace;
    }

    public function setNbrePlace(int $nbrePlace): self
    {
        $this->nbrePlace = $nbrePlace;

        return $this;
    }


    public function getIdEvent(): ?Evenement
    {
        return $this->idEvent;
    }


    public function setIdEvent(?Evenement $idEvent): void
    {
        $this->idEvent = $idEvent;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }


    public function setIdUser(?User $idUser): void
    {
        $this->idUser = $idUser;
    }


}
