<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetFormController extends AbstractController
{
    /**
     * @Route("/projet/form", name="projet_form")
     */
    public function index(): Response
    {
        return $this->render('projet_form/index.html.twig', [
            'controller_name' => 'ProjetFormController',
        ]);
    }
}
