<?php

namespace App\Controller;

use App\Entity\MonApprocheThérapeutique;
use App\Repository\MonApprocheThérapeutiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LesPatientController extends AbstractController
{
    #[Route('/les/patient', name: 'app_les_patient')]
    public function index(MonApprocheThérapeutiqueRepository $approcheRepo): Response
    {
        $article = new MonApprocheThérapeutique();

        $pages = $approcheRepo->findAll($article);
        return $this->render('les_patient/index.html.twig', [
            'pages' => $pages,
        ]);
    }
}
