<?php

namespace App\Services;

use App\Entity\Commande;

interface CommandeServiceInterface
{
    public function creer(Commande $commande): void;
    public function annuler(Commande $commande): void;
    public function terminer(Commande $commande): void;
}
