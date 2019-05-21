<?php

namespace App\Controller\Admin;

use App\Entity\Locations;
use App\Form\LocationsType;
use App\Repository\LocationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/locations")
 */
class AdminLocationsController extends AbstractController
{
    /**
     * @Route("/", name="admin.locations.index", methods={"GET"})
     */
    public function index(LocationsRepository $locationsRepository): Response
    {


        return $this->render('admin/locations/index.html.twig', [
            'locations' => $locationsRepository->findAllForUser($this->getUser()->getFamille()),
            'current_menu' => 'admin_locations'
        ]);
    }

    /**
     * @Route("/new", name="admin.locations.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $location = new Locations();
        $form = $this->createForm(LocationsType::class, $location, [
            'lock' => false,
            'family' => $this->getuser()->getFamille()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $location->setFamille($this->getUser()->getFamille());
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('admin.locations.index');
        }

        return $this->render('admin/locations/new.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
            'current_menu' => 'admin_locations',
            'lock' => false,
        ]);
    }

    /**
     * @Route("/{id}", name="locations_show", methods={"GET"})
     */
    public function show(Locations $location): Response
    {
        return $this->render('locations/show.html.twig', [
            'location' => $location,
            'current_menu' => 'admin_locations',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.locations.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Locations $location, LocationsRepository $repository): Response
    {

        if ($this->getUser()->getFamille() != $location->getFamille()) {
            $this->addFlash('error', "Vous avez été redirigé car vous n'avez pas l'autorisation d'éditer cet emplacement");
            return $this->redirectToRoute('admin.locations.index');
        }

        $subLocations = $repository->findSubLocations($location);
        $lock = false;
        if ($subLocations) {
            $lock = true;
        }
        $form = $this->createForm(LocationsType::class, $location, [
            'lock' => $lock,
            'family' => $this->getuser()->getFamille()
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.locations.index', [
                'id' => $location->getId(),
            ]);
        }

        return $this->render('admin/locations/edit.html.twig', [
            'location' => $location,
            'lock' => $lock,
            'form' => $form->createView(),
            'current_menu' => 'admin_locations'
        ]);
    }

    /**
     * @Route("/{id}", name="admin.locations.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Locations $location): Response
    {
        if ($this->isCsrfTokenValid('delete' . $location->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($location);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.locations.index');
    }
}
