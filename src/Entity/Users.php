<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $token = 'NULL';

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
     * @var int
     *
     * @ORM\Column(name="is_active", type="integer", nullable=false)
     */
    private $isActive;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

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

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }


}
