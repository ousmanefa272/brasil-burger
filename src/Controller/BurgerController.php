<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Form\BurgerType;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger')]
final class BurgerController extends AbstractController
{
    #[Route('/', name: 'burger_index')]
    public function index(BurgerRepository $repo): Response
    {
        return $this->render('burger/index.html.twig', [
            'burgers' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'burger_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($burger);
            $em->flush();

            return $this->redirectToRoute('burger_index');
        }

        return $this->render('burger/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
