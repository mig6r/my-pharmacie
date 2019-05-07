<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 29/04/2019
 * Time: 02:04
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/", name = "login")
     *
     */
    public function login(AuthenticationUtils $authUtil)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home');
        }

        $error = $authUtil->getLastAuthenticationError();
        $lastUsername = $authUtil->getLastUserName();

        return $this->render("security/login.twig.html", [
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);
    }
}