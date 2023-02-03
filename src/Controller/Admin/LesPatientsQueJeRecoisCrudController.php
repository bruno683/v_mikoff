<?php

namespace App\Controller\Admin;

use App\Entity\LesPatientsQueJeRecois;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LesPatientsQueJeRecoisCrudController extends AbstractCrudController
{

    public const IMAGE_BASE_PATH = 'upload/images/pages';
    public const IMAGE_UPLOAD_DIR= 'public/upload/images/pages';

    public static function getEntityFqcn(): string
    {
        return LesPatientsQueJeRecois::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('content', 'Contenu')->setNumOfRows(30),
            ImageField::new('image', 'image pour illustration de l\'article')->setBasePath(self::IMAGE_BASE_PATH)->setUploadDir(self::IMAGE_UPLOAD_DIR),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof LesPatientsQueJeRecois) return;

        parent::persistEntity($entityManager, $entityInstance);
    }
}
