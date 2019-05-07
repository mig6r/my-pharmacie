<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 06/05/2019
 * Time: 17:13
 */

namespace App\Controller;


use App\Entity\Famille;
use App\Entity\User;
use App\Repository\FamilleRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class FamilleController extends AbstractController
{

    /**
     * @param FamilleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/dash/familles", name="dash.familles.index")
     */
    public function index(FamilleRepository $repository): Response
    {
        /*
        if(!$this->getUser()->getFamille()){
            return $this->redirectToRoute("dash.familles.choice");
        }
        */
        $repositoryUser = $this->getDoctrine()->getRepository(User::class);
        $famille = $repository->find($this->getUser()->getFamille());
        $users = $repositoryUser->findUsersByFamille($this->getUser()->getFamille());

        return $this->render("familles/dashboard.twig", [
            "current_menu" => "familles",
            "famille" => $famille,
            "users" => $users
        ]);
    }

    /**
     * @Route("/dash/familles/switchadmin", name="dash.familles.switchadmin", methods="POST")
     */
    public function switchaAdmin(Request $request, ObjectManager $em)
    {
        $repositoryUser = $this->getDoctrine()->getRepository(User::class);
        $users = $repositoryUser->findUser($request->get('id'));
        $role[] = $request->get('role');
        $users->setRoles($role);
        $em->flush();
        return $this->redirectToRoute("dash.familles.index");
    }

    /**
     * @param Request $request
     * @param ObjectManager $em
     * @return Response
     * @Route("/dash/familles/init", name="dash.familles.init", methods="POST|GET")
     */
    public function new(Request $request, ObjectManager $em, FamilleRepository $repository, TokenGeneratorInterface $tokenGenerator)
    {
        $famille = new Famille();
        $repositoryUser = $this->getDoctrine()->getRepository(User::class);
        $user = $repositoryUser->findUser($this->getUser()->getId());
        $create = $this->createFormBuilder($famille)
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => "Nom de la nouvelle famille"],
                'label' => false
            ])
            ->getForm();
        $create->handleRequest($request);


        if ($create->isSubmitted() && $create->isValid()) {
            $famille->setToken($tokenGenerator->generateToken());
            $famille->setAdmin($user);
            $em->persist($famille);
            $em->flush();
            $user->setFamille($famille);
            //$roles=['ROLE_ADMIN'];
            $user->setRoles(['ROLE_ADMIN']);
            $em->flush();
            $this->addFlash('success', 'Votre famille ' . $famille->getName() . ' a bien été créée');
            return $this->redirectToRoute("home");
        }

        return $this->render('familles/init.html.twig', [
            'create' => $create->createView()
        ]);
    }

    /**
     * @param ObjectManager $em
     * @param FamilleRepository $famille
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @Route("/dash/familles/join", name="dash.familles.join", methods="join")
     */
    public function join(ObjectManager $em, FamilleRepository $famille, Request $request)
    {
        if ($this->isCsrfTokenValid('join' . $this->getUser()->getId(), $request->get('_token'))) {


            $repositoryUser = $this->getDoctrine()->getRepository(User::class);
            $user = $repositoryUser->findUser($this->getUser()->getId());
            $famille = $famille->findOneByFamille($request->get('token'));

            if ($famille) {
                $user->setFamille($famille);
                $em->flush();
                $this->addFlash('success', 'Vous avez bien été ajouté à la famille ' . $famille->getName());
                return $this->redirectToRoute("dash.index");
            }


            $this->addFlash('error', 'Le Token' . $request->get('token') . 'ne correspond à aucune famille');
            return $this->redirectToRoute("dash.familles.init");
        }
        $this->addFlash('error', 'Le Token de formulaire est invalide');
        return $this->redirectToRoute("dash.familles.init");

    }
}