<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 01/05/2019
 * Time: 11:02
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\UserType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="page.contact")
     *
     */
    public function show(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);

            $this->addFlash('success', 'Votre Email a bien été envoyé');
            return $this->redirectToRoute("page.contact");
        }

        return $this->render("pages/contact.html.twig", [
            "contact" => $contact,
            "current_menu" => "contact",
            "form" => $form->createView()
        ]);

    }



}