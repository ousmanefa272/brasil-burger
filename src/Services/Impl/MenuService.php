<?php

namespace App\Service\Menu;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;

class MenuService implements MenuServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private MenuRepository $repository
    ) {}

    public function create(Menu $menu): void
    {
        $this->em->persist($menu);
        $this->em->flush();
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function delete(Menu $menu): void
    {
        $this->em->remove($menu);
        $this->em->flush();
    }
}
