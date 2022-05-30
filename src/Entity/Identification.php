<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Identification
 *
 * @ORM\Table(name="identification")
 * @ORM\Entity
 */
class Identification
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
     * @var string
     *
     * @ORM\Column(name="type_identification", type="string", length=50, nullable=false)
     */
    private $typeIdentification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeIdentification(): ?string
    {
        return $this->typeIdentification;
    }

    public function setTypeIdentification(string $typeIdentification): self
    {
        $this->typeIdentification = $typeIdentification;

        return $this;
    }


}
