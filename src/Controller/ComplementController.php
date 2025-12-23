<?php

namespace App\Controller;

use App\Entity\Complement;
use App\Form\ComplementType;
use App\Repository\ComplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/complement')]
final class ComplementController extends AbstractController
{
    #[Route('/', name: 'complement_index')]
    public function index(ComplementRepository $repo): Response
    {
        return $this->render('complement/index.html.twig', [
            'complements' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'complement_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $complement = new Complement();
        $form = $this->createForm(ComplementType::class, $complement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($complement);
            $em->flush();

            return $this->redirectToRoute('complement_index');
        }

        return $this->render('complement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
