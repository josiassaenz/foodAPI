<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery", indexes={@ORM\Index(name="fk_id_beneficiary", columns={"id_beneficiarie"})})
 * @ORM\Entity
 */
class Delivery
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_beneficiarie", type="integer", nullable=false)
     */
    private $idBeneficiarie;

    /**
     * @var float
     *
     * @ORM\Column(name="kg", type="float", precision=255, scale=2, nullable=false)
     */
    private $kg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBeneficiarie(): ?int
    {
        return $this->idBeneficiarie;
    }

    public function setIdBeneficiarie(int $idBeneficiarie): self
    {
        $this->idBeneficiarie = $idBeneficiarie;

        return $this;
    }

    public function getKg(): ?float
    {
        return $this->kg;
    }

    public function setKg(float $kg): self
    {
        $this->kg = $kg;

        return $this;
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


}
