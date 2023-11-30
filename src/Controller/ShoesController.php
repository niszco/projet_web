<?php

namespace App\Controller;

use App\Entity\Shoes;
use App\Form\ShoesType;
use App\Repository\ShoesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shoes')]
class ShoesController extends AbstractController
{
    #[Route('/', name: 'app_shoes_index', methods: ['GET'])]
    public function index(ShoesRepository $shoesRepository): Response
    {
        return $this->render('shoes.html.twig', [
            'shoes' => $shoesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_shoes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shoe = new Shoes();
        $form = $this->createForm(ShoesType::class, $shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shoe);
            $entityManager->flush();

            return $this->redirectToRoute('app_shoes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shoes/new.html.twig', [
            'shoe' => $shoe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shoes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Shoes $shoe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoesType::class, $shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_shoes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shoes/edit.html.twig', [
            'shoe' => $shoe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shoes_delete', methods: ['POST'])]
    public function delete(Request $request, Shoes $shoe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($shoe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_shoes_index', [], Response::HTTP_SEE_OTHER);
    }
}
