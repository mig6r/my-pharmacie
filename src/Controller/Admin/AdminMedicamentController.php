<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 27/04/2019
 * Time: 14:38
 */

namespace App\Controller\Admin;


use App\Entity\Medicament;
use App\Entity\Symptome;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMedicamentController extends AbstractController
{
    /**
     * @var MedicamentRepository
     */
    private $repository;
    private $em;
    public function __construct(MedicamentRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.medicaments.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
$medicaments = $this->repository->findAll();
return $this->render("admin/medicaments/index.html.twig",  [
    "medicaments" => $medicaments,
    "current_menu" => "admin_medicaments",
]);
    }

    /**
     * @Route("/admin/medicament/create", name="admin.medicaments.new")
     */
    public function new(Request $request)
    {
        $medicament = new Medicament();
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($medicament);
            $this->em->flush();
            $this->addFlash('success', 'Le médicament a bien été créé');
            return $this->redirectToRoute("admin.medicaments.index");
        }

        return $this->render("admin/medicaments/new.html.twig", [
            "medicament" => $medicament,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/medicament/{id}", name="admin.medicaments.edit", methods="GET|POST")
     * @param Medicament $medicament
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Medicament $medicament,Request $request)
    {


        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $this->em->flush();
            $this->addFlash('success', 'Le médicament a bien été modifié');
            return $this->redirectToRoute("admin.medicaments.index");
        }
        return $this->render("admin/medicaments/edit.html.twig", [
            "medicament" => $medicament,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/medicament/{id}", name="admin.medicaments.delete", methods="DELETE")
     * @param Medicament $medicament
     */
    public function delete(Medicament $medicament, Request  $request)
    {
        if($this->isCsrfTokenValid('delete' . $medicament->getId(), $request->get('_token'))){
        $this->em->remove($medicament);
        $this->em->flush();
            $this->addFlash('success', 'Le médicament a bien été supprimé');
        }
    }

}