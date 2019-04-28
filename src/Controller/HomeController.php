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

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param MedicamentRepository $repository
     *
     */
public function index(MedicamentRepository $repository)
{
    $medicament = $repository->findLatest();
    return $this->render('pages/home.html.twig', [
        "current_menu" => "home",
        "medicaments" => $medicament
    ]);

}
}