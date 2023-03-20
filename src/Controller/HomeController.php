<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use App\Repository\ArticleRepository;
use App\Repository\QuiSuisJeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    /**
     * @param ArticleRepository $articleRepo
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */
    public function index(ArticleRepository $articleRepo,QuiSuisJeRepository $QuiSuisJeRepo , Request $request, MailerInterface $mailer ): Response
    {
        $title = "Vivianne Mikoff";
        $article = new Article();
        
        $lastPost = $QuiSuisJeRepo->findAll();
        $postOne = [];
        if ($lastPost) {
            $postOne = $lastPost[0];
        }else {
            $postOne = null;
        }
        
    
        
        
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
            ->to('contact@therapeute-mikoff.fr')
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
            'postOne' => $postOne,
            'form' => $form->createView()
        ]);
    }


    #[Route('/post/{id}', name: 'show_post', methods: ['GET'])]
    /**
     * @param Article $post
     * @param ArticleRepository $articleRepo
     * @return void
     */
    public function displayPost(Article $post, ArticleRepository $articleRepo)
    {   
        return $this->render('home/show.html.twig', [
            'article' => $post,
        ]);
    }
}
