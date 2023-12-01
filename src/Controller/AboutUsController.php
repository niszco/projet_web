<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AboutUsController extends AbstractController {

    #[Route('/about_us', name: 'about_us', methods: ["GET"])]
    public function load() : Response
    {
        return $this->render('about_us.html.twig', []);
    }
}
