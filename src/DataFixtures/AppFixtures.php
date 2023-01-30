<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Media;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // for( $n=1; $n <= 20; $n++){
        //     $media = (new Media())
        //         ->setFileName($faker->word())
        //         ->setAltText($faker->name)
        //         ->setName($faker->name());
        //     $manager->persist($media);
        // }
        
        
        $user = new User();
        $user->setEmail('bruno683@outlook.fr')
            ->setRoles(['admin'])
            ->setFullname('Bruno Richard')
            ->setPassword('bublegum');
            

            $manager->persist($user);

        
        // Création d'une boucle qui va créer 10 articles aléatoires
        // Chaque article aura un titre, un contenu, une date de publication qui seront générés aléatoirement
        // for ($i= 1 ; $i <= 10; $i++) {
        //     $article = new Article();
        //     $article->setTitle($faker->sentences(4))
        //         ->setImage($media->getFileName())
        //         ->setContent($faker->paragraphs(4))
        //         ->setCreatedAt($faker->dateTimeBetween( '- 6 month', 'now'))
        //         ->setIsPublished('true')
        //         ->setSlug($faker->sentence(1))
        //         ->setAuthor($user->getFullname());

        //     $manager->persist($article);
        // }

        $manager->flush();
    }
}
