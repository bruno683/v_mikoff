<?php

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,  MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $adress = $data['Email'];
            $name = $data['LastName'];
            $subject = $data['subject'];
            $firstName= $data['firstName'];
            $message = $data['message'];
            //header('Access-Control-Allow-Origin: *');
            
            $email = (new Email())
            ->from($name ." ". $firstName. '<contact@therapeute-mikoff.fr>')
            ->to('contact@therapeute-mikoff.fr')
            ->replyTo($adress)
            ->subject($subject)
            ->text($message);
            

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                //throw $th;
            }
            

            $this->addFlash('notice', 'Votre message à été envoyé avec succès !');

            return $this->redirectToRoute('app_contact');
        }

        // $faker = Faker/Factory::create();



        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
