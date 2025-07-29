<?php

// src/Dto/UserOutput.php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

class UserInput
{
    #[Assert\NotBlank]
    #[Groups(['user:write'])]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:write'])]
    public string $email;
}
