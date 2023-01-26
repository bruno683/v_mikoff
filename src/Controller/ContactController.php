<?php

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,  MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data['Email'];
            $message = $data['message'];
            header('Access-Control-Allow-Origin: *');
            $email = (new Email())
            ->from($email)
            ->to('Bruno683@outlook.fr')
            ->subject('demande de contact')
            ->text($message);
            

            $mailer->send($email);

            $this->addFlash('success', 'Votre message à été envoyé avec succès !');

            return $this->redirectToRoute('app_contact');
        }else {
            $this->addFlash('error', `Le message n'à pas été envoyé !!!!`);
        }



        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
