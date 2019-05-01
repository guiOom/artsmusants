<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaintingsRepository")
 * @UniqueEntity(
 *  fields="title",
 *  errorPath="title",
 *  message="Ce titre existe déjà !"
 * )
 */
class Paintings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\categories", inversedBy="paintings")
     */
    private $category;

    /**
     * @ORM\Column(type="smallint")
     */
    private $height;

    /**
     * @ORM\Column(type="smallint")
     */
    private $width;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bookings", mappedBy="painting")
     */
    private $bookings;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Sales", mappedBy="painting", cascade={"persist", "remove"})
     */
    private $sale;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?categories
    {
        return $this->category;
    }

    public function setCategory(?categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Bookings[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Bookings $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setPainting($this);
        }

        return $this;
    }

    public function removeBooking(Bookings $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getPainting() === $this) {
                $booking->setPainting(null);
            }
        }

        return $this;
    }

    public function getSale(): ?Sales
    {
        return $this->sale;
    }

    public function setSale(?Sales $sale): self
    {
        $this->sale = $sale;

        // set (or unset) the owning side of the relation if necessary
        $newPainting = $sale === null ? null : $this;
        if ($newPainting !== $sale->getPainting()) {
            $sale->setPainting($newPainting);
        }

        return $this;
    }
}
