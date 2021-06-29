<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectoryController extends AbstractController
{
    /**
     * @Route("/directory", name="directory")
     */
    public function index(): Response
    {
        return $this->render('directory/index.html.twig', [
            'controller_name' => 'DirectoryController',
        ]);
    }
}