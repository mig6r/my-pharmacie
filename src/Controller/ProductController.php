<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 21/05/2019
 * Time: 14:02
 */

namespace App\Controller;


use App\Entity\Products;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/dash/product/{id}", name="dash.product.substring", methods="SUBSTRING")
     *
     */

    public function substring(Products $product, Request $request, ObjectManager $em)
    {
        if ($this->isCsrfTokenValid('substring' . $product->getId(), $request->get('_token'))) {


            if (-1 !== $product->getInitialQuantity()) {
                $product->setQuantity($product->getQuantity() - 1);
            } else {

                $state = $product->getState();
                dump($state);
                if (0 == $state) {
                    $product->setState(1);
                } elseif (1 == $state) {
                    $product->setState(2);
                }
            }

            $em->flush();
            $this->addFlash('success', 'La quantité a bien été soustraite');
        }
        $med = $product->getMedicament();
        $slug = $med->getSlug();
        $idMedic = $med->getId();

        return $this->redirectToRoute("dash.medicament.detail", [
            "id" => $idMedic,
            "slug" => $slug
        ]);
    }

    /**
     * @Route("/dash/product/{id}", name="dash.product.delete", methods="DELETE")
     *
     */
    public function delete(Products $product, Request $request, ObjectManager $em)
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->get('_token'))) {


            $em->remove($product);
            $em->flush();
            $this->addFlash('success', 'Le produit a bien été supprimé');
        }
        $med = $product->getMedicament();
        $slug = $med->getSlug();
        $idMedic = $med->getId();

        return $this->redirectToRoute("dash.medicament.detail", [
            "id" => $idMedic,
            "slug" => $slug
        ]);
    }

    /**
     * @Route("/dash/product/{id}", name="dash.product.edit", methods="GET|POST")
     * @param Products $product
     * @param Request $request
     *
     */
    public function edit(Products $product, Request $request, ObjectManager $em)
    {
        $form = $this->createForm(ProductType::class, $product, [
            'famille' => $this->getUser()->getFamille()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $med = $product->getMedicament();
            $slug = $med->getSlug();
            $idMedic = $med->getId();
            $em->flush();
            $this->addFlash('success', 'Le produit a bien été modifié');

            return $this->redirectToRoute('dash.medicament.detail', [
                "id" => $idMedic,
                "slug" => $slug
            ]);

        }

         return $this->render("/products/edit.html.twig", [
            "product" => $product,
            "form" => $form->createView()
        ]);
    }
}