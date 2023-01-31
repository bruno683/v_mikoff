<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepo, Request $request, MailerInterface $mailer ): Response
    {
        $title = "Vivianne Mikoff";
        $article = new Article();
        $posts = $articleRepo->findPostPublished($article);

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
            ->from($name ." ". $firstName . " " . "<" . $adress .">")
            ->to('Bruno683@outlook.fr')
            ->replyTo($adress)
            ->subject($subject)
            ->text($message);
            

            $mailer->send($email);

            $this->addFlash('success', 'Votre message à été envoyé avec succès !');

            return $this->redirectToRoute('app_contact');
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => $title,
            'posts' =>  $posts,
            'form' => $form->createView()
        ]);
    }

    #[Route('/post/{id}', name: 'show_post')]
    public function displayPost(Article $article)
    {
        
        return $this->render('Home/show.html.twig', [
            'title' => $article->getTitle(),
            'article' => $article,
        ]);
    }
}
