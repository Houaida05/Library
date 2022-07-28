<?php

namespace App\Controller;

use App\Controller\Data\SearchData;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Form\EmpruntType;
use App\Form\LivreType;
use App\Form\RechercheLivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'accueil'=> False,
            'footer' => false,



    ]);
    }

    /**
     * @Route("/new", name="livre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="livre_show")
     */
    public function show(Livre $livre, Request $request): Response
    {   $emprunt=new Emprunt();
        $form = $this->createForm(EmpruntType::class,$emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emprunt->setUsers($this->getUser());
            $emprunt->setLivres($livre);
            if ($emprunt->getDateEmp()< $emprunt->getDateRet()) {
            $emprunt->getLivres()->setQteStock($emprunt->getLivres()->getQteStock()-1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();
            $this->addFlash("Success","Borrow added successfully");
            return $this->redirectToRoute('emprunt_index'); }
          else{
              $this->addFlash("Error"," Please verify the date");

           }
        }
            $livreRepository=$this->getDoctrine()->getRepository(Livre::class);
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
            'accueil'=> true,
            'livres' => $livreRepository->findAll(),
            'id'=> $livre->getId(),
            'em_form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete", methods={"POST"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/search", name="search" , priority="1")
     */
    public function search ( request $request)
    {
        $livres= null;

        $form = $this->createForm(RechercheLivreType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()) {
            $livreCat= $form->getData()->getCategorie();
            $livreTitre=$form->getData()->getTitre();
            $livrePrix=$form->getData()->getPrix();
            $livres= $this->getDoctrine()->getManager()->getRepository(Livre::class)->findByCat(["categorie"=> $livreCat], ["titre"=>$livreTitre], ["prix"=>$livrePrix]) ;
        }
        return $this->render('livre/search.html.twig',[
            'livres' => $livres,
            'form'=> $form->createView(),
            'accueil' => false,
            'footer' => false,

        ]);
    }
}
