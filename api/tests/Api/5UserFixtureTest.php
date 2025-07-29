<?php
//LiipTestFixturesBundle — підвантаження тестових даних (fixtures)
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class UserFixtureTest extends ApiTestCase
{
    public function testGetUsersFromFixtures(): void
    {
        // Завантаження фікстур (UserFixtures створює тестового користувача)
        self::getContainer()->get(DatabaseToolCollection::class)
            ->get()->loadFixtures(['App\DataFixtures\UserFixtures']);

        // GET-запит до /users
        $client = static::createClient();
        $client->request('GET', '/users');

        // Перевірка, що фікстура дійсно з'явилася в відповіді
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('fixture_user@example.com', $client->getResponse()->getContent());
    }
}
