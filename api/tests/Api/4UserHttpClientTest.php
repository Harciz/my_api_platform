<?php
//HttpClientInterface — тестує API як зовнішній клієнт
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserHttpClientTest extends KernelTestCase
{
    public function testUserApiStatus(): void
    {
        // Запуск ядра Symfony без повноцінного HTTP-клієнта
        self::bootKernel();
        $client = self::getContainer()->get(HttpClientInterface::class);

        // Надсилаємо запит до API
        $response = $client->request('GET', 'http://localhost/users');

        // Очікуємо 200 OK
        $this->assertEquals(200, $response->getStatusCode());
    }
}
