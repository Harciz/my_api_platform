<?php

namespace App\Tests\Api;
//ApiTestCase — основа для API Platform
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Product;

class ProductApiTest extends ApiTestCase
{
    public function testCreateProduct(): void
    {
        static::createClient()->request('POST', '/products', [
            'json' => [
                'name' => 'Phone',
                'price' => 499.99
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains(['name' => 'Phone']);
    }

    public function testGetProducts(): void
    {
        $response = static::createClient()->request('GET', '/products');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesJsonSchema([
            'type' => 'object',
            'required' => ['@context', '@type', 'hydra:member'],
        ]);
    }

    public function testValidation(): void
    {
        $response = static::createClient()->request('POST', '/products', [
            'json' => [
                'price' => null,
            ],
        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertJsonContains([
            'violations' => [
                ['propertyPath' => 'name'],
            ]
        ]);
    }
}
//**
 * Api Platform — це HATEOAS-фреймворк. 
 * У відповідях не тільки дані, але й метаінформація (@context, @id, hydra:member, hydra:totalItems і т.д.).
 * Тестуєш весь HTTP контракт: статуси, структуру, фільтри, валідацію
 *Api Platform формує повністю RESTful API автоматично — а ти це перевіряєш:
 *чи працює GET /products
 *чи повертає POST /products статус 201
 *чи обробляє валідацію
 *чи працюють фільтри: ?name=Phone, ?order[price]=asc
 *Не пишеш контролери — тестуєш авто-генеровану поведінку
 *Тобто це не чорний ящик: ти маєш перевірити, що ApiResource з input/output, groups, filters працює як задумано.
 *Часто просто конфігуруєш Entity + атрибути, і вся логіка — у метаданих.
 */