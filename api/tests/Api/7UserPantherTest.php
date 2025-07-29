<?php
//Panther (BrowserKit) — e2e в headless Chrome  API через реальний браузер (JavaScript, UI, SEO).
use Symfony\Component\Panther\PantherTestCase;

class UserPantherTest extends PantherTestCase
{
    public function testApiInBrowser(): void
    {
        // Тестуємо API як реальний браузер
        $client = static::createPantherClient();

        $crawler = $client->request('GET', '/users');

        // Просто smoke test — що сторінка існує
        $this->assertSelectorExists('body');
    }
}
