<?php

namespace App\Service\Complement;

use App\Entity\Complement;
use App\Repository\ComplementRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComplementService implements ComplementServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private ComplementRepository $repository
    ) {}

    public function create(Complement $complement): void
    {
        $this->em->persist($complement);
        $this->em->flush();
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function delete(Complement $complement): void
    {
        $this->em->remove($complement);
        $this->em->flush();
    }
}
