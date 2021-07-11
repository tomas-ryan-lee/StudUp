<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PageProjetController extends AbstractController
{
    /**
     * @Route("/page/projet/{id}", name="page_projet")
     */
    public function index(int $id): Response
    {
        $phases = [
            "14.3" => "Étude de marché",
            "28.6" => "Étude de besoins",
            "42.9" => "Validation du concept",
            "57.1" => "Rédaction du business plan",
            "71.4" => "Création de MVP",
            "85.7" => "Test utilisateurs",
            "100.00" => "Lancement sur le marché"
        ];
        $response = $this->forward('App\Controller\Api\ProjectController::get', ['id' => $id]);
        $project = json_decode($response->getContent(), true);

        $percentage = array_search($project['currentPhase'], $phases);

        if (isset($project['video'])) {
            $project['video'] = str_replace('watch?v=', 'embed/', $project['video']);
        }
        return $this->render(
            'page_projet/index.html.twig',
            [
                'controller_name' => 'PageProjetController',
                'project' => $project,
                'percentage' => $percentage,
            ]
        );
    }
}
