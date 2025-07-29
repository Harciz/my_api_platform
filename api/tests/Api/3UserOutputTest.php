<?php

use PHPUnit\Framework\TestCase;
use App\Dto\UserOutput;

class UserOutputTest extends TestCase
{
    public function testOutputDtoStructure(): void
    {
        // Створення об'єкта вихідного DTO
        $dto = new UserOutput(1, 'Alice', 'alice@example.com');

        // Перевірка полів DTO
        $this->assertEquals(1, $dto->id);
        $this->assertEquals('Alice', $dto->name);
        $this->assertEquals('alice@example.com', $dto->email);
    }
}
