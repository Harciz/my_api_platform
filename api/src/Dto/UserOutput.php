<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

class UserOutput
{
    #[Groups(['user:read'])]
    public int $id;

    #[Groups(['user:read'])]
    public string $name;

    #[Groups(['user:read'])]
    public string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}