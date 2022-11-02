<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beneficiaries
 *
 * @ORM\Table(name="beneficiaries", indexes={@ORM\Index(name="fk_identification", columns={"type_identification"}), @ORM\Index(name="fk_countries", columns={"country"}), @ORM\Index(name="fk_name_road", columns={"name_road"}), @ORM\Index(name="fk_provinces", columns={"province"}), @ORM\Index(name="fk_status_documents", columns={"status_documents"}), @ORM\Index(name="fk_location", columns={"location"})})
 * @ORM\Entity
 */
class Beneficiaries
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
     * @ORM\Column(name="names", type="string", length=255, nullable=false)
     */
    private $names;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="born", type="date", nullable=false)
     */
    private $born;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $email = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="signture", type="text", length=65535, nullable=false)
     */
    private $signture;

    /**
     * @var string
     *
     * @ORM\Column(name="first_surname", type="string", length=255, nullable=false)
     */
    private $firstSurname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="second_surname", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $secondSurname = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="cel_phone", type="string", length=255, nullable=false)
     */
    private $celPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="number_identification", type="string", length=255, nullable=false)
     */
    private $numberIdentification;

    /**
     * @var string|null
     *
     * @ORM\Column(name="other_direction", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $otherDirection = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="family_unit", type="integer", nullable=false)
     */
    private $familyUnit;

    /**
     * @var int
     *
     * @ORM\Column(name="terms_conditions", type="integer", nullable=false)
     */
    private $termsConditions;

    /**
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="status_documents", type="date", nullable=false)
     */
    private $statusDocuments;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location", referencedColumnName="id")
     * })
     */
    private $location;

    /**
     * @var \Provinceses
     *
     * @ORM\ManyToOne(targetEntity="Provinceses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="province", referencedColumnName="id")
     * })
     */
    private $province;

    /**
     * @var \Identification
     *
     * @ORM\ManyToOne(targetEntity="Identification")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_identification", referencedColumnName="id")
     * })
     */
    private $typeIdentification;

    /**
     * @var \NameRoad
     *
     * @ORM\ManyToOne(targetEntity="NameRoad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="name_road", referencedColumnName="id")
     * })
     */
    private $nameRoad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(string $names): self
    {
        $this->names = $names;

        return $this;
    }

    public function getBorn(): ?\DateTimeInterface
    {
        return $this->born;
    }

    /**
     * 
     * @param \DateTime $born
     * @return Beneficiaries
    */
    public function setBorn(\DateTime $born): self
    {
        $this->born = $born;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSignture(): ?string
    {
        return $this->signture;
    }

    public function setSignture(string $signture): self
    {
        $this->signture = $signture;

        return $this;
    }

    public function getFirstSurname(): ?string
    {
        return $this->firstSurname;
    }

    public function setFirstSurname(string $firstSurname): self
    {
        $this->firstSurname = $firstSurname;

        return $this;
    }

    public function getSecondSurname(): ?string
    {
        return $this->secondSurname;
    }

    public function setSecondSurname(?string $secondSurname): self
    {
        $this->secondSurname = $secondSurname;

        return $this;
    }

    public function getCelPhone(): ?string
    {
        return $this->celPhone;
    }

    public function setCelPhone(string $celPhone): self
    {
        $this->celPhone = $celPhone;

        return $this;
    }

    public function getNumberIdentification(): ?string
    {
        return $this->numberIdentification;
    }

    public function setNumberIdentification(string $numberIdentification): self
    {
        $this->numberIdentification = $numberIdentification;

        return $this;
    }

    public function getOtherDirection(): ?string
    {
        return $this->otherDirection;
    }

    public function setOtherDirection(?string $otherDirection): self
    {
        $this->otherDirection = $otherDirection;

        return $this;
    }

    public function getFamilyUnit(): ?int
    {
        return $this->familyUnit;
    }

    public function setFamilyUnit(int $familyUnit): self
    {
        $this->familyUnit = $familyUnit;

        return $this;
    }

    public function getTermsConditions(): ?int
    {
        return $this->termsConditions;
    }

    public function setTermsConditions(int $termsConditions): self
    {
        $this->termsConditions = $termsConditions;

        return $this;
    }

    public function getStatusDocuments(): ?StatusDocuments
    {
        return $this->statusDocuments;
    }

    public function setStatusDocuments(?StatusDocuments $statusDocuments): self
    {
        $this->statusDocuments = $statusDocuments;

        return $this;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getProvince(): ?Provinceses
    {
        return $this->province;
    }

    public function setProvince(?Provinceses $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getTypeIdentification(): ?Identification
    {
        return $this->typeIdentification;
    }

    public function setTypeIdentification(?Identification $typeIdentification): self
    {
        $this->typeIdentification = $typeIdentification;

        return $this;
    }

    public function getNameRoad(): ?NameRoad
    {
        return $this->nameRoad;
    }

    public function setNameRoad(?NameRoad $nameRoad): self
    {
        $this->nameRoad = $nameRoad;

        return $this;
    }


}
