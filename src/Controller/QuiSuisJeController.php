<?php

namespace App\Controller;

use App\Entity\QuiSuisJe;
use App\Repository\QuiSuisJeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuiSuisJeController extends AbstractController
{
    #[Route('/qui/suis/je', name: 'app_qui_suis_je')]
    public function index(QuiSuisJeRepository $QuiSuisJeRepo): Response
    {
        $article = new QuiSuisJe();

        $pages = $QuiSuisJeRepo->findAll($article);
        return $this->render('qui_suis_je/index.html.twig', [
            'pages' => $pages,
        ]);
    }
}
