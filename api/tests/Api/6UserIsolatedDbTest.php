<?php
//DoctrineTestBundle — ізольоване тестування без "бруднення" БД після тестів.
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UserIsolatedDbTest extends ApiTestCase
{
    public function testIsolatedUserCreation(): void
    {
        // Тест використовує транзакції (ізоляція від інших тестів)
        static::createClient()->request('POST', '/users', [
            'json' => ['name' => 'Isolated', 'email' => 'iso@example.com'],
        ]);

        // Якщо цей тест виконається, а база повернеться в початковий стан — все працює
        $this->assertResponseStatusCodeSame(201);
    }
}

dama_doctrine_test:
    enable_static_connection: true
    enable_static_meta_data_cache: true