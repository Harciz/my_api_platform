<?php
//ReadOnly DTO – ресурс тільки для GET (без сутності)
namespace App\Dto;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;

namespace App\Dto;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DTO, який є самостійним ресурсом (без сутності).
 * Наприклад: статистика, агреговані дані, статуси тощо.
 */
#[ApiResource(
    operations: [new GetCollection()],
    normalizationContext: ['groups' => ['public-stats:read']]
)]
class PublicStatsDto
{
    #[Groups(['public-stats:read'])]
    public int $userCount;

    #[Groups(['public-stats:read'])]
    public int $productCount;

    #[Groups(['public-stats:read'])]
    public \DateTimeInterface $generatedAt;

    public function __construct(int $userCount, int $productCount)
    {
        $this->userCount = $userCount;
        $this->productCount = $productCount;
        $this->generatedAt = new \DateTimeImmutable();
    }
}
