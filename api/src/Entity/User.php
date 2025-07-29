<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Dto\UserInput;
use App\Dto\UserOutput;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']],
    operations: [
        new GetCollection(output: UserOutput::class),
        new Get(output: UserOutput::class),
        new Post(
            input: UserInput::class,
            output: UserOutput::class
        )
    ]
)]
class User
{
    // Унікальний ідентифікатор користувача (генерується автоматично)
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private ?int $id = null;

    // Ім'я користувача, обов'язкове, до 100 символів
    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    #[Groups(['user:read', 'user:write'])]
    private string $name;

    // Email користувача, обов'язковий, повинен бути валідним email
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:write'])]
    private string $email;

    // Геттер для ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Геттер для name
    public function getName(): string
    {
        return $this->name;
    }

    // Сеттер для name
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Геттер для email
    public function getEmail(): string
    {
        return $this->email;
    }

    // Сеттер для email
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }
}
