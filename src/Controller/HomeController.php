<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController {

    #[Route('/', name: 'home', methods: ["GET"])]
    public function home(EntityManagerInterface $entityManager) : Response
    {
        return $this->render('home.html.twig', []);
    }
}

