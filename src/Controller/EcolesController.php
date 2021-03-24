<?php

namespace App\Controller;

use App\Form\AddEcoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcolesController extends AbstractController
{
    /**
     * @Route("/ecoles", name="ecoles")
     */
    public function index(): Response
    {
        return $this->render('ecoles/index.html.twig', [
            'controller_name' => 'EcolesController',
        ]);
    }

    /**
     * @Route("/ajouter-ecole", name="ajouter_ecole")
     */
    public function addSchool(): Response
    {
        $form = $this->createForm(AddEcoleType::class);

        return $this->render('ecoles/ajout-ecole.html.twig', [
            "form" => $form->createView(),
            'controller_name' => 'EcolesController',
        ]);
    }

}
