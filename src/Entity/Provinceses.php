<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provinceses
 *
 * @ORM\Table(name="provincesEs")
 * @ORM\Entity
 */
class Provinceses
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
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $code = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="postalCode", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $postalcode = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $name = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="phoneCode", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $phonecode = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="iso2", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $iso2 = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPostalcode(): ?int
    {
        return $this->postalcode;
    }

    public function setPostalcode(?int $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhonecode(): ?int
    {
        return $this->phonecode;
    }

    public function setPhonecode(?int $phonecode): self
    {
        $this->phonecode = $phonecode;

        return $this;
    }

    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    public function setIso2(?string $iso2): self
    {
        $this->iso2 = $iso2;

        return $this;
    }


}
