<?php

namespace App\Controller\Admin;

use App\Entity\Symptome;
use App\Form\SymptomeType;
use App\Repository\SymptomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/symptome")
 */
class AdminSymptomeController extends AbstractController
{
    /**
     * @Route("/", name="admin.symptome.index", methods={"GET"})
     */
    public function index(SymptomeRepository $symptomeRepository): Response
    {
        return $this->render('admin/symptomes/index.html.twig', [
            'symptomes' => $symptomeRepository->findAllForUser($this->getUser()->getFamille()),
            "current_menu" => "admin_symptomes"
        ]);
    }

    /**
     * @Route("/new", name="admin.symptome.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $symptome = new Symptome();
        $form = $this->createForm(SymptomeType::class, $symptome, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symptome->setFamille($this->getUser()->getFamille());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($symptome);
            $entityManager->flush();

            return $this->redirectToRoute('admin.symptome.index');
        }

        return $this->render('admin/symptomes/new.html.twig', [
            'symptome' => $symptome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.symptome.show", methods={"GET"})

    public function show(Symptome $symptome): Response
    {
        return $this->render('admin/symptome/show.html.twig', [
            'symptome' => $symptome,
        ]);
    }
*/
    /**
     * @Route("/{id}/edit", name="admin.symptome.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Symptome $symptome): Response
    {
        if($this->getUser()->getFamille() != $symptome->getFamille()){
            $this->addFlash('error', "Vous avez été redirigé car vous n'avez pas l'autorisation d'éditer ce symptome");
            return $this->redirectToRoute('admin.groups.index');
        }
        $form = $this->createForm(SymptomeType::class, $symptome, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.symptome.index', [
                'id' => $symptome->getId(),
            ]);
        }

        return $this->render('admin/symptomes/edit.html.twig', [
            'symptome' => $symptome,
            'form' => $form->createView(),
            "current_menu" => "admin_symptomes"
        ]);
    }

    /**
     * @Route("/{id}", name="admin.symptome.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Symptome $symptome): Response
    {
        if ($this->isCsrfTokenValid('delete'.$symptome->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($symptome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.symptome.index');
    }
}
