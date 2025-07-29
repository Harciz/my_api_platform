<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\CustomProductController;
use App\Dto\ProductInput;
use App\State\ProductInputProcessor;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    output: Product::class,
    normalizationContext: ['groups' => ['product:read']],
    operations: [
        new GetCollection(),
        new Get(),
        new Post(
            input: ProductInput::class,
            processor: ProductInputProcessor::class,
            normalizationContext: ['groups' => ['product:read']],
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
#[ApiFilter(OrderFilter::class, properties: ['price'])]
class Product
{
    // ID — первинний ключ, автогенерується БД
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read'])] // Включається в JSON-вивід при GET
    private ?int $id = null;

    // Назва продукту (max 255 символів), не може бути порожньою
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank] // Перевірка: не порожнє значення
    #[Groups(['product:read', 'product:write'])] // Вивід + прийом
    private string $name;

    // Ціна продукту, обов'язкова
    #[ORM\Column]
    #[Assert\NotNull] // Не можна залишати порожнім
    #[Groups(['product:read', 'product:write'])] // Вивід + прийом
    private float $price;

    // Геттер для ID (тільки читання)
    public function getId(): ?int
    {
        return $this->id;
    }

    // Геттер для name
    public function getName(): string
    {
        return $this->name;
    }

    // Сеттер для name (повертає self для чейнінгу)
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Геттер для price
    public function getPrice(): float
    {
        return $this->price;
    }

    // Сеттер для price
    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }
}