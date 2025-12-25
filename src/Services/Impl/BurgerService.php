<?php

namespace App\Service\Burger;

use App\Entity\Burger;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;

class BurgerService implements BurgerServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private BurgerRepository $repository
    ) {}

    public function create(Burger $burger): void
    {
        $this->em->persist($burger);
        $this->em->flush();
    }

    public function update(): void
    {
        $this->em->flush();
    }

    public function delete(Burger $burger): void
    {
        $this->em->remove($burger);
        $this->em->flush();
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function getById(int $id): ?Burger
    {
        return $this->repository->find($id);
    }
}
