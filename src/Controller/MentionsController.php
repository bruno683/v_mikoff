<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    #[Route('/mentions', name: 'app_mentions')]
    public function index(): Response
    {
        $editorName = 'coddadict';
        $editorAdress = '47 rue compère 47550 Boe, France';
        $immatNumber = '88046991100015';
        $siteName = 'thérapeute';
        $hostName = 'Hostinger.com';
        return $this->render('mentions/index.html.twig', [
            
        ]);
    }
}
