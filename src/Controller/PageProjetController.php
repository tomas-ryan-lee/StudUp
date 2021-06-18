<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageProjetController extends AbstractController
{
    /**
     * @Route("/page/projet", name="page_projet")
     */
    public function index(): Response
    {
        return $this->render('page_projet/index.html.twig', [
            'controller_name' => 'PageProjetController',
        ]);
    }
}
