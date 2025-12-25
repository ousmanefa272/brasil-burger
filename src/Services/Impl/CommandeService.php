<?php

namespace App\Service\Commande;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;

class CommandeService implements CommandeServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function creer(Commande $commande): void
    {
        $commande->setEtat('EN_COURS');
        $commande->setDateCommande(new \DateTime());

        $this->em->persist($commande);
        $this->em->flush();
    }

    public function annuler(Commande $commande): void
    {
        $commande->setEtat('ANNULEE');
        $this->em->flush();
    }

    public function terminer(Commande $commande): void
    {
        $commande->setEtat('TERMINEE');
        $this->em->flush();
    }
}
