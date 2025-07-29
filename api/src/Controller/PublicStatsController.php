<?php

namespace App\Controller;

use App\Dto\PublicStatsDto;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PublicStatsController
{
    public function __invoke(): PublicStatsDto
    {
        // Тут може бути логіка звернення до БД, сервісів тощо
        $usersCount = 1000;
        $productsCount = 150;

        return new PublicStatsDto($usersCount, $productsCount);
    }
}
