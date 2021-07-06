<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\AddStudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(): Response
    {
        //$student = new Student();
        $form = $this->createForm(AddStudentType::class);

        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            'form' => $form->createView(),
        ]);
    }
}
