<?php

namespace App\Controller;

use App\Entity\Shoes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController {

    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $entityManager) : Response
    {
        $shoesRepository = $entityManager->getRepository(Shoes::class);
        $shoes = $shoesRepository->findAll();

        return $this->render('home.html.twig', [
            'shoes' => $shoes,
        ]);
    }
}

?>