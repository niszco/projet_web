<?php

namespace App\Controller;

use App\Entity\Clothes;
use App\Form\ClothesType;
use App\Repository\ClothesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clothes')]
class ClothesController extends AbstractController
{
    #[Route('/', name: 'app_clothes_index', methods: ['GET'])]
    public function index(ClothesRepository $clothesRepository): Response
    {
        return $this->render('clothes.html.twig', [
            'clothes' => $clothesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_clothes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $clothes = new Clothes();
        $form = $this->createForm(ClothesType::class, $clothes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($clothes);
            $entityManager->flush();

            return $this->redirectToRoute('app_clothes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('clothes/new.html.twig', [
            'clothes' => $clothes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clothes_show', methods: ['GET'])]
    public function show(Clothes $clothes): Response
    {
        return $this->render('clothes/show.html.twig', [
            'clothes' => $clothes,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_clothes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Clothes $clothes, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClothesType::class, $clothes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_clothes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('clothes/edit.html.twig', [
            'clothes' => $clothes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clothes_delete', methods: ['POST'])]
    public function delete(Request $request, Clothes $clothes, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clothes->getId(), $request->request->get('_token'))) {
            $entityManager->remove($clothes);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_clothes_index', [], Response::HTTP_SEE_OTHER);
    }
}
