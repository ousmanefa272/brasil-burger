<?php

namespace App\Service\Complement;

use App\Entity\Complement;

interface ComplementServiceInterface
{
    public function create(Complement $complement): void;
    public function getAll(): array;
    public function delete(Complement $complement): void;
}
