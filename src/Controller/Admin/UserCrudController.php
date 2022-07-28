<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserCrudController extends AbstractCrudController implements PasswordAuthenticatedUserInterface
{
    private $em;
    private $passhash;

    /**
     * @param $em
     * @param $passhash
     */
    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passhash)
    {
        $this->em = $em;
        $this->passhash = $passhash;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('Email'),
            TextField::new('name'),
            TextField::new('firstname'),
            TelephoneField::new("tel"),
            TextField::new('password')->setFormType(passwordType::class)->hideOnIndex()->hideWhenUpdating(),
            ArrayField::new('roles')->hideOnIndex(),

        ];
    }

    public function getPassword(): ?string
    {
        // TODO: Implement getPassword() method.
        return $this->password;
    }
        public function createEntity(string $entityFqcn)
        {
        $user = new User();
        return $user;
        }
        public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void

        {$password = $entityInstance->getPassword();$entityInstance
            ->setPassword($this->passhash->hashPassword($entityInstance,$password) );
        $entityManager->persist($entityInstance);
        $entityManager->flush();
        }
        }
