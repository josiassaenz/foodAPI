<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusDocuments
 *
 * @ORM\Table(name="status_documents")
 * @ORM\Entity
 */
class StatusDocuments
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
     * @ORM\Column(name="status", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $status = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
