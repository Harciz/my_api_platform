<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DTO для кастомного виводу.
 * Наприклад: додаємо поле "isDiscounted", яке не зберігається в БД напряму.
 */
class ProductOutputDto
{
    #[Groups(['product:read'])]
    public int $id;

    #[Groups(['product:read'])]
    public string $name;

    #[Groups(['product:read'])]
    public string $description;

    #[Groups(['product:read'])]
    public float $price;

    #[Groups(['product:read'])]
    public bool $isDiscounted;

    public function __construct(
        int $id,
        string $name,
        string $description,
        float $price,
        bool $isDiscounted,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->isDiscounted = $isDiscounted;
    }
}