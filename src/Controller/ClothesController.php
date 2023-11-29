<?php

namespace App\Controller;

use App\Entity\Clothes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ClothesController extends AbstractController {

    #[Route('/clothes', name: 'clothes')]
    public function home(EntityManagerInterface $entityManager) : Response
    {
        $clothesRepository = $entityManager->getRepository(Clothes::class);
        $clothes = $clothesRepository->findAll();

        return $this->render('clothes.html.twig', [
            'clothes' => $clothes,
        ]);
    }
}
