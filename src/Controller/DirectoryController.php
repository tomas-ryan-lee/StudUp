<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectoryController extends AbstractController
{
    /**
     * @Route("/directory", name="directory")
     */
    public function index(Request $request): Response
    {
        
        $projects = json_decode($this->forward('App\Controller\Api\ProjectController::getAll', ['request' => $request]), true);

        return $this->render('directory/index.html.twig', [
            'controller_name' => 'DirectoryController',
            'projects' => $projects,
        ]);
    }
}
