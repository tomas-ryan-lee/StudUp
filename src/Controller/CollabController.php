<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollabController extends AbstractController
{
    /**
     * @Route("/collab", name="collab")
     */
    public function index(): Response
    {
        return $this->render('collab/index.html.twig', [
            'controller_name' => 'CollabController',
        ]);
    }
}
