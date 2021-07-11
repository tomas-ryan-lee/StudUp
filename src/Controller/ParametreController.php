<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParametreController extends AbstractController
{
    /**
     * @Route("/parametre", name="parametre")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        // TODO : manage settings save
        $student = $this->getUser()->getStudent()->toArray();
        return $this->render('parametre/index.html.twig', [
            'controller_name' => 'ParametreController',
            'student' => $student,
        ]);
    }
}
