<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Proxies\__CG__\App\Entity\User as EntityUser;

class ArticleCrudController extends AbstractCrudController
{
    
    
    public const IMAGE_BASE_PATH = 'upload/images/articles';
    public const IMAGE_UPLOAD_DIR= 'public/upload/images/articles';
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $user = $this->getUser();
        
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('content', 'Contenu')->setNumOfRows(30),
            ImageField::new('image')->setBasePath(self::IMAGE_BASE_PATH)->setUploadDir(self::IMAGE_UPLOAD_DIR),
            SlugField::new('slug')->setTargetFieldName('title'),
            BooleanField::new('isPublished', 'Publié')->onlyOnForms(),
            AssociationField::new('author', 'Auteur'),
            DateTimeField::new('createdAt', 'Créé le')->hideOnForm(),
            DateTimeField::new('updatedAt', 'Mis à jour le')->hideOnIndex()->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Article) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());


        parent::persistEntity($entityManager, $entityInstance);

        // $entityManager->persist($entityInstance)->flush();
    }
    
}
