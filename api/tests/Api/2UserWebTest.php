<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//WebTestCase — для низькорівневих Symfony штук (роути, шаблони, авторизація)
class UserWebTest extends WebTestCase
{
    public function testGetUsersRoute(): void
    {
        // Ініціалізація HTTP клієнта
        $client = static::createClient();

        // GET-запит до /users
        $client->request('GET', '/users');

        // Перевірка, що відповідь успішна (200 OK)
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
