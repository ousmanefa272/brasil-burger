<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/paiement')]
final class PaiementController extends AbstractController
{
    #[Route('/', name: 'paiement_index')]
    public function index(PaiementRepository $repo): Response
    {
        return $this->render('paiement/index.html.twig', [
            'paiements' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'paiement_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $paiement = new Paiement();
        $paiement->setDate(new \DateTime());

        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($paiement);
            $em->flush();

            return $this->redirectToRoute('paiement_index');
        }

        return $this->render('paiement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
