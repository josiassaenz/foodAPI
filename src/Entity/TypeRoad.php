<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeRoad
 *
 * @ORM\Table(name="type_road")
 * @ORM\Entity
 */
class TypeRoad
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
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="key_road", type="string", length=255, nullable=false)
     */
    private $keyRoad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getKeyRoad(): ?string
    {
        return $this->keyRoad;
    }

    public function setKeyRoad(string $keyRoad): self
    {
        $this->keyRoad = $keyRoad;

        return $this;
    }


}
