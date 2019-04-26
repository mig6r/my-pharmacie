<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 26/04/2019
 * Time: 08:47
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
public function index(): Response
{
    return $this->render('pages/home.html.twig');
}
}