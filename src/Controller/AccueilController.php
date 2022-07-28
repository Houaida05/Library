<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    { $livreRepository=$this->getDoctrine()->getRepository(Livre::class);
        $auteurRepository=$this->getDoctrine()->getRepository(Auteur::class);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'livres' => $livreRepository->findAll(),
            'accueil'=>true,
            'footer' =>true,



        ]);
    }
}
