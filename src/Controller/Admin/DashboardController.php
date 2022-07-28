<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\User;
use App\Repository\CategorieRepository;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;
    /**
     * @var LivreRepository
     */
    protected LivreRepository $livreRepository;

    /**
     * @var EmpruntRepository
     */
    protected EmpruntRepository $empruntRepository;
    /**
     * @var CategorieRepository
     */
    protected CategorieRepository $categorieRepository;

    public function __construct(
        UserRepository $userRepository,
        LivreRepository $livreRepository,
        EmpruntRepository $empruntRepository,
        CategorieRepository $categorieRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->livreRepository= $livreRepository;
        $this->empruntRepository = $empruntRepository;
        $this->categorieRepository =$categorieRepository;

    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countUser' => $this->userRepository->countAllUser(),
            'countLivre' => $this->livreRepository->countAllBook(),
            'countBorrow' => $this->empruntRepository->countAllBorrow(),
            'categories' => $this-> categorieRepository->findAll(),
            'books'=> $this-> livreRepository->findAll(),
            'borrows'=> $this-> empruntRepository->findAll(),
            'users'=>$this->userRepository->findAll(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Biblio')
            ->setFaviconPath('logo.png');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Livre::class);
        yield MenuItem::linkToCrud('Editeurs', 'fas fa-book-open ', Editeur::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-bars', Categorie::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-pen-fancy', Auteur::class);
        yield MenuItem::linkToCrud('Utilisateurs','fas fa-user',User::class);
        yield MenuItem::linkToCrud('Emprunts','fas fa-handshake',Emprunt::class);


    }
}
