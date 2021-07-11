<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\Api\StudentController;

class FavoritesController extends AbstractController
{
    /**
     * @Route("/favorites", name="favorites")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $studentId = $this->getUser()->getProfile()->getId();
        $fyProjects = json_decode($this->forward('App\Controller\Api\ProjectController::forYouProject', ['id' => $studentId]), true);
        
        $student = $this->getUser()->getProfile();
        return $this->render(
            'favorites/index.html.twig', 
            [
            'controller_name' => 'FavoritesController',
            'userId' => $student->getId(),
            'favorites' => $student->getFavorites(),
            'fyprojects' => $fyProjects,
            ]
        );
    }
}
