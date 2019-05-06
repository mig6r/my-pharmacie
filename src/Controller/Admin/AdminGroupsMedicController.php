<?php

namespace App\Controller\Admin;

use App\Entity\GroupsMedic;
use App\Form\GroupsMedicType;
use App\Repository\GroupsMedicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/groups")
 */
class AdminGroupsMedicController extends AbstractController
{

    /**
     * @Route("/", name="admin.groups.index", methods={"GET"})
     */
    public function index(GroupsMedicRepository $groupsMedicRepository): Response
    {
        $famille = $this->getUser()->getFamille();
        return $this->render('admin/groups/index.html.twig', [
            'groups_medics' => $groupsMedicRepository->findAllForUser($famille),
            'current_menu' => 'admin_groups'
        ]);
    }

    /**
     * @Route("/new", name="admin.groups.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $groupsMedic = new GroupsMedic();
        $form = $this->createForm(GroupsMedicType::class, $groupsMedic, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupsMedic->setFamille($this->getUser()->getFamille());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupsMedic);
            $entityManager->flush();

            return $this->redirectToRoute('admin.groups.index');
        }

        return $this->render('admin/groups/new.html.twig', [
            'groups_medic' => $groupsMedic,
            'form' => $form->createView(),
            'current_menu' => 'admin_groups'
        ]);
    }

    /**
     * @Route("/{id}", name="groups_medic_show", methods={"GET"})

    public function show(GroupsMedic $groupsMedic): Response
    {
        return $this->render('groups_medic/show.html.twig', [
            'groups_medic' => $groupsMedic,
        ]);
    }
*/
    /**
     * @Route("/{id}/edit", name="admin.groups.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GroupsMedic $groupsMedic): Response
    {
        if($this->getUser()->getFamille() != $groupsMedic->getFamille()){
            $this->addFlash('error', "Vous avez été redirigé car vous n'avez pas l'autorisation d'éditer ce groupe");
            return $this->redirectToRoute('admin.groups.index');
        }

        $form = $this->createForm(GroupsMedicType::class, $groupsMedic, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le groupe a bien été édité');
            return $this->redirectToRoute('admin.groups.index');
        }

        return $this->render('admin/groups/edit.html.twig', [
            'groups_medic' => $groupsMedic,
            'form' => $form->createView(),
            'current_menu' => 'admin_groups'
        ]);
    }

    /**
     * @Route("/{id}", name="admin.groups.delete", methods={"DELETE"})
     */
    public function delete(Request $request, GroupsMedic $groupsMedic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupsMedic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupsMedic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.groups.index');
    }
}
