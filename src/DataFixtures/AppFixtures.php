<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Media;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;


class AppFixtures extends Fixture
{
    private  $hasher;
    
    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        $user = new User();
        $plainPassword = 'toto47';
        $encoded = $this->hasher->hashPassword($user, $plainPassword);
        $user->setEmail("bruno683@outlook.fr")
            ->setPassword($encoded)
            ->setRoles(['admin'])
            ->setFullname('Richard Bruno');

        $manager->persist($user);

        for ($i=0; $i <=10 ; $i++) { 
            $media = (new Media())
                ->setName($faker->word())
                ->setFileName($faker->word())
                ->setAltText($faker->sentence());
            $manager->persist($media);
        }


        for ($i=1; $i <= 5  ; $i++) { 
            $article = (new Article())
                ->setTitle($faker->sentence())
                ->setContent($faker->text(500))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setIsPublished(true)
                ->setImage($media)
                ->setAuthor($user)
                ->setSlug($faker->slug());


            $manager->persist($article);
        }





        $manager->flush();
    }
}
