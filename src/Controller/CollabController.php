<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollabController extends AbstractController
{
    /**
     * @Route("/collab", name="collab")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $response = $this->forward('App\Controller\Api\ProjectMemberController::getAll');
        $projectMembers = json_decode($response->getContent(), true);
        $student = $this->getUser()->getProfile()->toArray();

        $collaborations = [];
        $applyments = [];
        foreach($projectMembers as $projectMember) {
            if($projectMember['student'] != null && $projectMember['student']['id'] == $student['id']) {
                $collaborations[] = $projectMember;
            } else {
                $applicants = $projectMember['applicants'];
                foreach ($applicants as $applicant) {
                    if ($applicant['id'] == $student['id']) {
                        $applyments[] = $projectMember;
                    }
                }
            }
        }


        return $this->render('collab/index.html.twig', [
            'controller_name' => 'CollabController',
            'student' => $student,
            'collaborations' => $collaborations,
            'applyments' => $applyments
        ]);
    }
}
