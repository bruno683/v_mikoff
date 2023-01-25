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
            
            $email = (new Email())
            ->from($email)
            ->to('70a5e9d3e8-ac006b+1@inbox.mailtrap.io')
            ->subject('Time for Symfony Mailer!')
            ->text($message);
            

            $mailer->send($email);

            $this->addFlash('success', 'Votre message à été envoyé avec succès !');

            return $this->redirectToRoute('app_contact');
        }



        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
