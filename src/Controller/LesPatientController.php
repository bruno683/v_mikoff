<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LesPatientController extends AbstractController
{
    #[Route('/les/patient', name: 'app_les_patient')]
    public function index(): Response
    {
        return $this->render('les_patient/index.html.twig', [
            'controller_name' => 'LesPatientController',
        ]);
    }
}
