<?php

namespace App\Controller;

use App\Security\UserChecker;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\UserType;


class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="page.register")
     */

    public function index(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $em)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'validation_groups' => array('User', 'registration')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
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
