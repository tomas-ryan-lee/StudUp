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
            "Étude de marché",
            "Étude de besoins",
            "Validation du concept",
            "Rédaction du business plan",
            "Création d’un MVP",
            "Test utilisateurs",
            "Lancement sur le marché"
        ];
        $response = $this->forward('App\Controller\Api\ProjectController::get', ['id' => $id]);
        $project = json_decode($response->getContent(), true);

        $percentage = (100 * (array_search($project['currentPhase'], $phases) + 1) / 8) + "%";

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
