<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(['name'])]
#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min: 8)]
    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 15)]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\NotBlank()]
    #[ORM\Column]
    private ?int $price_month = null;

    #[Assert\NotBlank()]
    #[ORM\Column]
    private ?int $price_day = null;

    #[Assert\NotBlank()]
    #[Assert\Range(min: 2, max: 8)]
    #[ORM\Column]
    private ?int $seats = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 255)]
    private ?string $gearbox = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceMonth(): ?int
    {
        return $this->price_month;
    }

    public function setPriceMonth(int $price_month): static
    {
        $this->price_month = $price_month;

        return $this;
    }

    public function getPriceDay(): ?int
    {
        return $this->price_day;
    }

    public function setPriceDay(int $price_day): static
    {
        $this->price_day = $price_day;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): static
    {
        $this->seats = $seats;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(string $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }
}
