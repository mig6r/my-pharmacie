<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 26/04/2019
 * Time: 08:47
 */

namespace App\Controller;


use App\Repository\MedicamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/dash", name="home")
     * @param MedicamentRepository $repository
     *
     */
public function index(MedicamentRepository $repository)
{

    //$usertest = $this->getUser()->getId();
    //var_dump($usertest);

    if(!$this->getUser()->getFamille()){
        return $this->redirectToRoute("dash.familles.init");
    }
    //var_dump($this->getUser()->getFamille());
    $medicament = $repository->findLatest($this->getUser()->getFamille());
    return $this->render('pages/home.html.twig', [
        "current_menu" => "home",
        "medicaments" => $medicament,
        //"user" => $usertest
    ]);

}
}