<?php

namespace App\Services;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientService implements ClientServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientRepository $repository
    ) {}

    public function create(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function getById(int $id): ?Client
    {
        return $this->repository->find($id);
    }

    public function getByTelephone(string $telephone): ?Client
    {
        return $this->repository->findOneBy([
            'telephone' => $telephone
        ]);
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }
}
