<?php

namespace App\Services;

use App\Entity\Commande;
use App\Entity\Paiement;
use Doctrine\ORM\EntityManagerInterface;

class PaiementService implements PaiementServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function payer(Commande $commande, Paiement $paiement): void
    {
        if ($commande->getPaiement()) {
            throw new \Exception("Commande déjà payée");
        }

        $paiement->setCommande($commande);
        $paiement->setDatePaiement(new \DateTime());

        $this->em->persist($paiement);
        $this->em->flush();
    }
}
