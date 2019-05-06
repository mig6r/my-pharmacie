<?php

namespace App\Controller\Admin;

use App\Entity\CatMedicaments;
use App\Form\CatMedicamentsType;
use App\Repository\CatMedicamentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories")
 */
class AdminCatMedicamentsController extends AbstractController
{

    /**
     * @Route("/", name="admin.categories.index", methods={"GET"})
     */
    public function index(CatMedicamentsRepository $catMedicamentsRepository): Response
    {

        return $this->render('admin/categories/index.html.twig', [
            'cat_medicaments' => $catMedicamentsRepository->findAllForUser($this->getUser()->getFamille()),
            'current_menu' => 'admin_categories'
        ]);
    }

    /**
     * @Route("/new", name="admin.categories.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $catMedicament = new CatMedicaments();
        $form = $this->createForm(CatMedicamentsType::class, $catMedicament, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catMedicament->setFamille($this->getUser()->getFamille());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($catMedicament);
            $entityManager->flush();

            return $this->redirectToRoute('admin.categories.index');
        }

        return $this->render('admin/categories/new.html.twig', [
            'cat_medicament' => $catMedicament,
            'form' => $form->createView(),
            'current_menu' => 'admin_categories'
        ]);
    }

    /**
     * @Route("/{id}", name="admin.categories.show", methods={"GET"})
     */
    public function show(CatMedicaments $catMedicament): Response
    {
        return $this->render('admin/categories/show.html.twig', [
            'cat_medicament' => $catMedicament,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.categories.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CatMedicaments $catMedicament): Response
    {
        if($this->getUser()->getFamille() != $catMedicament->getFamille()){
            $this->addFlash('error', "Vous avez été redirigé car vous n'avez pas l'autorisation d'éditer cette catégorie");
            return $this->redirectToRoute('admin.categories.index');
        }

        $form = $this->createForm(CatMedicamentsType::class, $catMedicament, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La catégorie a bien été éditée');
            return $this->redirectToRoute('admin.categories.index');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'cat_medicament' => $catMedicament,
            'form' => $form->createView(),
            'current_menu' => 'admin_categories'
        ]);

    }

    /**
     * @Route("/{id}", name="admin.categories.delete", methods={"DELETE"})
     */
    public function delete(Request $request, CatMedicaments $catMedicament): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catMedicament->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catMedicament);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.categories.index');
    }
}
