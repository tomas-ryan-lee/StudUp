<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditProjetController extends AbstractController
{
    /**
     * @Route("/edit/projet/{id}", name="edit_projet")
     */
    public function index(int $id): Response
    {
        // TODO
        return $this->render('edit_projet/index.html.twig', [
            'controller_name' => 'EditProjetController',
        ]);
    }
}
