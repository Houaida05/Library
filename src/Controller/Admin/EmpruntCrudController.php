<?php

namespace App\Controller\Admin;

use App\Entity\Emprunt;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmpruntCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emprunt::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('users'),
            AssociationField::new('livres'),
            DateField::new('dateEmp'),
            DateField::new('dateRet'),


        ];
    }
/*public function createEntity(string $entityFqcn)
{
    $emprunt = new Emprunt();
    return $emprunt;
}


    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
  $li=$entityInstance->getLivres()->setQteStock($entityInstance->getLivres()->getQteStock()-1);
  $entityManager->persist($li);
  $entityManager->flush();
    } */

}
