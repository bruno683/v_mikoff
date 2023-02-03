<?php

namespace App\Controller\Admin;

use App\Entity\QuiSuisJe;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class QuiSuisJeCrudController extends AbstractCrudController
{
    public const IMAGE_BASE_PATH = 'upload/images/articles';
    public const IMAGE_UPLOAD_DIR= 'public/upload/images/articles';
    public static function getEntityFqcn(): string
    {
        return QuiSuisJe::class;
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
    
}
