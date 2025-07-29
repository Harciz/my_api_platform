<?php

// src/State/ProductInputProcessor.php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\ProductInput;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductInputProcessor implements ProcessorInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Product
    {
        if (!$data instanceof ProductInput) {
            throw new \InvalidArgumentException('Expected ProductInput.');
        }

        $product = new Product();
        $product->setName($data->name);
        $product->setPrice($data->price);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }
}
