# API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information.

1. Symfony HTTP-тести (WebTestCase / KernelTestCase)
🔹 ApiTestCase (від API Platform)
API Platform надає свій базовий клас ApiPlatform\Symfony\Bundle\Test\ApiTestCase, який значно спрощує написання тестів:


use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ProductTest extends ApiTestCase
{
    public function testCreateProduct(): void
    {
        static::createClient()->request('POST', '/api/products', [
            'json' => [
                'name' => 'Test product',
                'price' => 9.99,
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['name' => 'Test product']);
    }
}
 Плюс: автоматичні assertResponseStatusCodeSame, assertJsonContains, інтеграція з Symfony Profiler, Schema validation.

 2. Тестування GraphQL (якщо використовується)
Також через ApiTestCase:

$response = static::createClient()->request('POST', '/api/graphql', [
    'json' => ['query' => '{ products { edges { node { name } } } }']
]);

$this->assertResponseIsSuccessful();
$this->assertJsonContains(['data' => ['products' => []]]);

3. Validation тестування
Перевірка валідаційних помилок:

$response = static::createClient()->request('POST', '/api/products', [
    'json' => [
        'price' => -1 // name is missing, price is invalid
    ],
]);

$this->assertResponseStatusCodeSame(422);
$this->assertJsonContains([
    'violations' => [
        ['propertyPath' => 'name'],
        ['propertyPath' => 'price'],
    ],
]);

4. Безпека та авторизація (JWT / OAuth2 / etc)
Можна тестувати авторизовані запити через передачу токенів:


$client = static::createClient();
$token = $this->getTokenForUser('admin@example.com');

$client->request('GET', '/api/secure-resource', [
    'headers' => ['Authorization' => 'Bearer ' . $token],
]);

$this->assertResponseIsSuccessful();

5. Тестування Hydra / OpenAPI документації

curl -H "Accept: application/ld+json" https://localhost/api
Або перевірити, що документація доступна:

$response = static::createClient()->request('GET', '/api/docs.jsonld');
$this->assertResponseIsSuccessful();

6. Фронтові інтеграції (BrowserKit, Panther)
Якщо потрібно — можна використовувати Symfony Panther (headless Chrome) для перевірки інтеграції API + UI.

🧰 Інші корисні інструменти
Інструмент / Підхід	Призначення
ApiTestCase	Просте API-тестування
symfony/test-pack	Набір для WebTestCase
doctrine/test-bundle	Транзакційні тести
liip/test-fixtures-bundle	Фікстури для даних
Postman / Insomnia	Ручне тестування
OpenAPI Validator (external)	Перевірка відповідності OpenAPI