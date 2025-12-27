<?php

namespace App\Services;

use App\Entity\Commande;
use App\Entity\Paiement;

interface PaiementServiceInterface
{
    public function payer(Commande $commande, Paiement $paiement): void;
}
