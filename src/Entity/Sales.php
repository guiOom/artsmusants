<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalesRepository")
 */
class Sales
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\paintings", inversedBy="sale", cascade={"persist", "remove"})
     */
    private $painting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\customers", inversedBy="sales")
     */
    private $customer;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $canceled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPainting(): ?paintings
    {
        return $this->painting;
    }

    public function setPainting(?paintings $painting): self
    {
        $this->painting = $painting;

        return $this;
    }

    public function getCustomer(): ?customers
    {
        return $this->customer;
    }

    public function setCustomer(?customers $customer): self
    {
        $this->customer = $customer;

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

    public function getCanceled(): ?bool
    {
        return $this->canceled;
    }

    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }
}
