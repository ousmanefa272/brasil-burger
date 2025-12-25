<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Form\BurgerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BurgerController extends AbstractController
{
    public function index(EntityManagerInterface $em): Response
    {
        $burgers = $em->getRepository(Burger::class)->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }

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

    public function edit(
        Request $request,
        Burger $burger,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('burger_index');
        }

        return $this->render('burger/new.html.twig', [
            'form' => $form->createView(),
            'burger' => $burger,
        ]);
    }
}