<?php

namespace App\Controller;

use App\Entity\LesPatientsQueJeRecois;
use App\Entity\MonApprocheThérapeutique;
use App\Repository\LesPatientsQueJeRecoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LesPatientController extends AbstractController
{
    #[Route('/les/patient', name: 'app_les_patient')]
    public function index(LesPatientsQueJeRecoisRepository $approcheRepo): Response
    {
        $article = new LesPatientsQueJeRecois();

        $pages = $approcheRepo->findAll($article);
        return $this->render('les_patient/index.html.twig', [
            'pages' => $pages,
        ]);
    }
}
