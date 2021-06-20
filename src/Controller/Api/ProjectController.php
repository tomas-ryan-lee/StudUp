<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Domain;
use App\Entity\Project;
use App\Entity\ProjectMember;
use App\Repository\ProjectRepository;

class ProjectController {
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/projects", name="get_all_projects", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $projects = $this->projectRepository->findAll();
        $data = [];
        foreach($projects as $project) {
            $data[] = $project->toArray();
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/projects/{id}", name="get_one_project", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $project = $this->projectRepository->findOneBy(['id' => $id]);

        if(empty($project)) {
            return new JsonResponse(
                ['error' => 'Project with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $project->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/projects", name="create_one_project", methods={"POST"})
     */
    public function add(Request $request) : JsonResponse {
        $data = json_decode($request->getContent(), true);
        $domainRepository = $this->getDoctrine->getRepository(Domain::class);

        if(
            !isset($data['name']) ||
            !isset($data['incubator']) ||
            !isset($data['location']) ||
            !isset($data['currentPhase']) ||
            !isset($data['phases']) ||
            !isset($data['globalVision']) ||
            !isset($data['elevatorSpeech']) ||
            !isset($data['asset']) ||
            !isset($data['lookingFor']) ||
            !isset($data['mood']) ||
            !isset($data['impact']) ||
            !isset($data['domainIds'])
        ) {
            return new JsonResponse(
                ['error' => "Missing mandatory fields"],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $name = $data['name'];
        $domains = $domainRepository->findBy(['id' => $data['domainIds']]);
        $location = $data['location'];
        $currentPhase = $data['currentPhase'];
        $phases = $data['phases'];
        $globalVision = $data['globalVision'];
        $elevatorSpeech = $data['elevatorSpeech'];
        $asset = $data['asset'];
        $lookingFor = $data['lookingFor'];
        $mood = $data['mood'];
        $impact = $data['impact'];
        $members = [];

        $logo = isset($data['logo']) ? $data['logo'] : null;
        $video = isset($data['video']) ? $data['video'] : null;
        $videoOrLogoDisplayed = isset($data['videoOrLogo']) ? $data['videoOrLogo'] : null;
    
        $project = $this->projectRepository->saveProject(
            $name,
            $incubator,
            $location,
            $logo,
            $video,
            $videoOrLogo,
            $currentPhase,
            $phases,
            $globalVision,
            $elevatorSpeech,
            $asset,
            $lookingFor,
            $mood,
            $hasImpact,
            $domains,
            $members
        );

        $data = $student->toArray();
        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/projects/{id}", name="remove_one_project", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $student = $this->projectRepository->findOneBy(['id' => $id]);
        $this->projectRepository->removeProject($project);
        return new JsonResponse(
            ['status' => "Student deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/project/{id}", name="update_one_project", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $project = $this->projectRepository->findOneBy(["id" => $id]);
        $domainRepository = $this->getDoctrine->getRepository(Domain::class);
        $data = json_decode($request->getContent(), true);

        isset($data['name']) ? $project->setName($data['name']) : true;
        isset($data['incubator']) ? $project->setIncubator($data['incubator']) : true;
        isset($data['location']) ? $project->setLocation($data['location']) : true;
        isset($data['logo']) ? $project->setLogo($data['logo']) : true;
        isset($data['video']) ? $project->setVideo($data['video']) : true;
        isset($data['videoOrLogo']) ? $project->setDisplayedContent($data['videoOrLogo']) : true;
        isset($data['currentPhase']) ? $project->setCurrentPhase($data['currentPhase']) : true;
        isset($data['phases']) ? $project->setPhases($data['phases']) : true;
        isset($data['globalVision']) ? $project->setGlobalVision($data['globalVision']) : true;
        isset($data['elevatorSpeech']) ? $project->setElevatorSpeech($data['elevatoSpeech']) : true;
        isset($data['asset']) ? $project->setAsset($data['asset']) : true;
        isset($data['lookingFor']) ? $project->setLookingFor($data['lookingFor']) : true;
        isset($data['mood']) ? $project->setMood($data['mood']) : true;
        isset($data['hasImpact']) ? $project->setHasImpact($data['hasImpact']) : true;
        
        if(isset($data['domainIds'])) {
            $project->setDomains($domainRepository->findBy(['id' => $data['domainIds']]));
        }
        
        $updatedProject = $this->projectRepository->updateProject($project);

        return new JsonResponse($updatedProject->toArray(), Response::HTTP_OK);
    }
}
