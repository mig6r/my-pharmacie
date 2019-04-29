<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 26/04/2019
 * Time: 10:29
 */

namespace App\Controller;


use App\Entity\Medicament;
use App\Entity\MedicamentFilter;
use App\Form\MedicamentFilterType;
use App\Repository\MedicamentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicamentController extends AbstractController
{
    /**
     * @var
     */
    private $repository;
    /**
     * @var
     */
    private $em;

    public function __construct(MedicamentRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/medicaments", name="medicament.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        //On ajoute le formulaire de recherche et on le passe en argument à la requette
        $search = new MedicamentFilter();
        $form = $this->createForm(MedicamentFilterType::class, $search);
        $form->handleRequest($request);

        //on récupère la requette SQL dans le repository
        $queryMedicament = $this->repository->findAllEnableQuery($search);

        //On utilise le bundle Paginator KNP
        $medicament = $paginator->paginate(
            $queryMedicament,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render("medicaments/index.html.twig", [
            "current_menu" => "medicaments",
            "medicaments" => $medicament,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/medicaments/{slug}-{id}", name="medicament.detail", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function detail($slug, Medicament $medicament): Response
    {
        //$medicament = $this->repository->find($id);
        ///*A la place de mettre $id en argument et de faire une recherche avec la méthode find comme ci-dessus,
        /// on peut faire une injection de l'entity Medicament, etant donné que symfony trouve un id, symfony va faire
        /// la recherche à notre place

        if ($medicament->getSlug() !== $slug) {
            return $this->redirectToRoute("medicament.detail", [
                "id" => $medicament->getId(),
                "slug" => $medicament->getSlug()
            ], 301);
        }
        return $this->render("medicaments/detail.html.twig", [
            "medicament" => $medicament,
            "current_menu" => "medicaments",
            "slug" => $slug
        ]);
    }


}