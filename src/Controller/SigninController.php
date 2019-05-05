<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use App\Entity\User;
use App\Form\UserType;

class SigninController extends AbstractController
{
    /**
     * @Route("/signin", name="page.signin")
     */

    public function index(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $em)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre compte a bien été créé');
            return $this->redirectToRoute("login");
        }

        return $this->render('pages/register.html.twig', [
            'form' => $form->createView(),
            'mainNavRegistration' => true,
            'current_menu' => 'Inscription']);
    }
}
