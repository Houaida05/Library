<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
         return [
            TextField::new('titre'),
            TextField::new('ISBN'),
             AssociationField::new('categorie'),
             AssociationField::new('auteurs'),
             AssociationField::new('editeur'),
            ImageField::new('image')
                ->setBasePath('/uploads/images/books')->onlyOnIndex(),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)->onlyWhenCreating(),
             NumberField::new('prix'),
             NumberField::new('qteStock'),
             DateField::new('dateEdition'),

        ];
    }

}
