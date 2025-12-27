<?php

namespace App\Services;

use App\Entity\Menu;

interface MenuServiceInterface
{
    public function create(Menu $menu): void;
    public function getAll(): array;
    public function delete(Menu $menu): void;
}
