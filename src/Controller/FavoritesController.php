<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\Api\StudentController;

class FavoritesController extends AbstractController
{
    /**
     * @Route("/favorites", name="favorites")
     */
    public function index(): Response
    {
        return $this->render('favorites/index.html.twig', [
            'controller_name' => 'FavoritesController',
        ]);
        $student = $this->getUser()->getProfile();
        return $this->render(
            'favorites/index.html.twig', 
            [
            'controller_name' => 'FavoritesController',
            'userId' => $student->getId(),
            'favorites' => $student->getFavorites(),
            ]
        );
    }
}
