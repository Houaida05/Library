<?php

namespace App\Controller;

use App\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordController extends AbstractController
{
    /**
     * @Route("/password", name="password")
     */
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher): Response
    {
          //  $this->addFlash('message', 'Password updated');

                if ($request->isMethod('POST')) {
                    $em=$this->getDoctrine()->getManager();
                    $user =$this->getUser();
                    if($request->request->get('pass')==$request->request->get('pass2')) {
                        $user->setPassword($passwordHasher->hashPassword($user,$request->request->get('pass')));
                        $em->flush();
                        $this->addFlash('message', 'Password updated');
                        return $this->redirectToRoute('profile');
                    }else {
                        $this->addFlash('error', 'Passwords are not identical');
                    }
                }

            return $this->render('profile/password.html.twig', [
                'accueil'=> 'false',

        ]);
    }
}
