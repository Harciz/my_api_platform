<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DTO використовується при POST/PUT/PATCH — отримання даних від клієнта.
 * Не пов’язаний з Doctrine.
 */
class ProductInputDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Groups(['product:write'])]
    public string $name;

    #[Assert\NotBlank]
    #[Groups(['product:write'])]
    public string $description;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    #[Groups(['product:write'])]
    public float $price;
}