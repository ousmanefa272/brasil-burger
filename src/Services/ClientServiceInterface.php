<?php

namespace App\Service\Client;

use App\Entity\Client;

interface ClientServiceInterface
{
    public function create(Client $client): void;
    public function getById(int $id): ?Client;
    public function getByTelephone(string $telephone): ?Client;
    public function getAll(): array;
}
