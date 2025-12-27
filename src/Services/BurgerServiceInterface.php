<?php

namespace App\Services;

use App\Entity\Burger;

interface BurgerServiceInterface
{
    public function create(Burger $burger): void;
    public function update(): void;
    public function delete(Burger $burger): void;
    public function getAll(): array;
    public function getById(int $id): ?Burger;
}
