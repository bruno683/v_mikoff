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
        $siteName = 'www.therapeute-mikoff.fr';
        $hostName = 'Hostinger.com';
        $contactMail = 'contact@codaddict.fr';
        return $this->render('mentions/index.html.twig', [
            'editor_name' => $editorName,
            'editor_adress' => $editorAdress,
            'immat_number' => $immatNumber,
            'site_name' => $siteName,
            'host_name' => $hostName,
            'contact_mail' => $contactMail
        ]);
    }
}
