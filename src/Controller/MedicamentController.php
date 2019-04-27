<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 26/04/2019
 * Time: 10:29
 */

namespace App\Controller;


use App\Entity\Medicament;
use App\Repository\MedicamentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
public function index(): Response
{

$medicament = $this->repository->findAllEnable();
dump($medicament);

return $this->render("medicaments/index.html.twig", [
    "current_menu" => "medicaments"
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

    if($medicament->getSlug() !== $slug){
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