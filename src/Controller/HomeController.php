<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 26/04/2019
 * Time: 08:47
 */

namespace App\Controller;


use App\Repository\CatMedicamentsRepository;
use App\Repository\GroupsMedicRepository;
use App\Repository\MedicamentRepository;
use App\Repository\SymptomeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, MedicamentRepository $repoMedics, GroupsMedicRepository $repoGroups, SymptomeRepository $repoSymptomes, CatMedicamentsRepository $repoCats, Request $request)
    {

        if (!$this->getUser()->getFamille()) {
            return $this->redirectToRoute("dash.familles.init");
        }

        //$medicaments = $repoMedics->findLatest($this->getUser()->getFamille());
        $queryMedicament = $repoMedics->findLatest($this->getUser()->getFamille());
        $groups = $repoGroups->findAllForUser($this->getUser()->getFamille());
        $medicaments = $paginator->paginate(
            $queryMedicament,
            $request->query->getInt('page', 1),
            6
        );
        $cats = $repoCats->findAllForUser($this->getUser()->getFamille());
        $symptomes = $repoSymptomes->findAllForUser($this->getUser()->getFamille());
    return $this->render('pages/home.html.twig', [
        "current_menu" => "home",
        "medicaments" => $medicaments,
        "symptomes" => $symptomes,
        "categories" => $cats,
        "groups" => $groups
    ]);

}
}