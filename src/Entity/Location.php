<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
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
     * @ORM\Column(name="code_municipality", type="integer", nullable=false)
     */
    private $codeMunicipality;

    /**
     * @var string
     *
     * @ORM\Column(name="name_municipality", type="string", length=255, nullable=false)
     */
    private $nameMunicipality;

    /**
     * @var int
     *
     * @ORM\Column(name="code_ine_municipality", type="integer", nullable=false)
     */
    private $codeIneMunicipality;

    /**
     * @var int
     *
     * @ORM\Column(name="code_nuts4", type="integer", nullable=false)
     */
    private $codeNuts4;

    /**
     * @var string
     *
     * @ORM\Column(name="name_nuts4", type="string", length=255, nullable=false)
     */
    private $nameNuts4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeMunicipality(): ?int
    {
        return $this->codeMunicipality;
    }

    public function setCodeMunicipality(int $codeMunicipality): self
    {
        $this->codeMunicipality = $codeMunicipality;

        return $this;
    }

    public function getNameMunicipality(): ?string
    {
        return $this->nameMunicipality;
    }

    public function setNameMunicipality(string $nameMunicipality): self
    {
        $this->nameMunicipality = $nameMunicipality;

        return $this;
    }

    public function getCodeIneMunicipality(): ?int
    {
        return $this->codeIneMunicipality;
    }

    public function setCodeIneMunicipality(int $codeIneMunicipality): self
    {
        $this->codeIneMunicipality = $codeIneMunicipality;

        return $this;
    }

    public function getCodeNuts4(): ?int
    {
        return $this->codeNuts4;
    }

    public function setCodeNuts4(int $codeNuts4): self
    {
        $this->codeNuts4 = $codeNuts4;

        return $this;
    }

    public function getNameNuts4(): ?string
    {
        return $this->nameNuts4;
    }

    public function setNameNuts4(string $nameNuts4): self
    {
        $this->nameNuts4 = $nameNuts4;

        return $this;
    }


}
