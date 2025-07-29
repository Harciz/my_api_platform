<?php

namespace App\DataTransformer;

use ApiPlatform\Dto\DtoInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Serializer\SerializerContextBuilderInterface;
use ApiPlatform\State\DataTransformerInterface;
use App\Entity\User;
use App\Dto\UserOutput;


class UserOutputDataTransformer implements DataTransformerInterface
{
    public function transform(mixed $data, string $to, array $context = []): UserOutput
    {
        /** @var User $data */
        return new UserOutput(
            $data->getId(),
            $data->getName(),
            $data->getEmail()
        );
    }

    public function supportsTransformation(mixed $data, string $to, array $context = []): bool
    {
        return $data instanceof User && $to === UserOutput::class;
    }
}