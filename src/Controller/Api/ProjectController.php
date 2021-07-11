<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Domain;
use App\Entity\Project;
use App\Entity\ProjectFactor;
use App\Entity\ProjectMember;
use App\Entity\Student;
use App\Repository\ProjectRepository;

class ProjectController extends AbstractController {
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/api/projects", name="get_all_projects", methods={"GET"})
     */
    public function getAll(Request $request) : JsonResponse {

        $query = $request->query;
        $data = [];
        $projects = $this->projectRepository->findAll();

        if (!empty($query->all())) {
        // TODO : améliorer le tri

            foreach ($projects as $project) {
                $parametersNumber = array_sum([
                    $query->has('location'),
                    $query->has('domains'),
                    $query->has('jobs'),
                    $query->has('types')
                ]);
                $filtersNumber = array_sum([
                    ($query->has('location') && in_array($project->getLocation(), $query->get('location'))),
                    ($query->has('domains') && count(array_intersect($query->get('domains'), $project->getDomainsNames())) >= 1),
                    ($query->has('jobs') && count(array_intersect($query->get('jobs'), $project->getJobsNames())) >= 1),
                    ($query->has('types') && count(array_intersect($query->get('types'), $project->getJobsTypes())) >= 1),
                ]);
                if ($parametersNumber == $filtersNumber) {
                    $data[] = $project->toArray();
                }
            }


        } else {

            foreach($projects as $project) {
                $data[] = $project->toArray();

            }
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
        $domainRepository = $this->getDoctrine()->getRepository(Domain::class);

        if(
            !isset($data['name']) ||
            !isset($data['authorId']) ||
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
        $author = $studentRepository->findOneBy(['id' => $data['authorId']]);
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
            $author,
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
     * @Route("/api/projects/{id}", name="update_one_project", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $project = $this->projectRepository->findOneBy(["id" => $id]);
        $domainRepository = $this->getDoctrine()->getRepository(Domain::class);
        $data = json_decode($request->getContent(), true);

        isset($data['name']) ? $project->setName($data['name']) : true;
        isset($data['authorId']) ? $project->setAuthor($studentRepository->findOneBy(['id' => $data['authorId']])) : true;
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
    
    private function weightCalc(mixed $a, mixed $b) : int {
        if (!is_array($a) && !is_array($b)) {
            return ($a == $b);
        }
        if (is_array($a) && !is_array($b)) {
            return in_array($b, $a);
        }
        if (!is_array($a) && is_array($b)) {
            return in_array($a, $b);
        }
        if (is_array($a) && is_array($b)) {
            return count(array_intersect($a, $b));
        }
    }
    
    private function processAlgorithm($filters) : JsonResponse {
        // TODO : apply filter for getting less projects
        $projects = $this->projectRepository->findAll();
        $factors = [
            'domain' => ProjectFactor::DOMAIN_FACTOR,
            'location' => ProjectFactor::LOCATION_FACTOR,
            'currentPhase' => ProjectFactor::CURRENT_PHASE_FACTOR,
            'asset' => ProjectFactor::ASSET_FACTOR,
            'lookingFor' => ProjectFactor::LOOKING_FOR_FACTOR,
            'mood' => ProjectFactor::MOOD_FACTOR,
            'hasImpact' => ProjectFactor::HAS_IMPACT_FACTOR,
            'job' => ProjectFactor::JOB_FACTOR,
            'jobCategory' => ProjectFactor::JOB_CATEGORY_FACTOR,
        ];
        $projectScores = [];
        foreach($projects as $project) {
            $projectFeatures = [
                'location' => $project->getLocation(),
                'currentPhase' => $project->getCurrentPhase(),
                'asset' => $project->getAsset(),
                'lookingFor' => $project->getLookingFor(),
                'mood' => $project->getMood(),
                'hasImpact' => $project->getHasImpact(),
            ];
            $domains = $project->getDomains();
            foreach($domains as $domain) {
                $projectFeatures['domains'][] = $domain->getName();
            }
            $members = $project->getMembers();
            foreach($members as $member) {
                $projectFeatures['job'][] = $member->getJob()->getName();
                $projectFeatures['jobCategory'][] = $member->getJob()->getCategory();
            }
            $weight = array_map(array($this, 'weightCalc'), $filters, $projectFeatures);
            $factoredWeight = array_map(function($x, $y) { return $x *$y; }, $weight, $factors);
            $projectScores[$project->getId()] = array_sum($factoredWeight);
        }
        $sortedProjects = [];

        arsort($projectScores, SORT_NUMERIC);
        foreach($projectScores as $projectId => $projectScore) {
            $sortedProjects[] = $this->projectRepository->findOneBy(['id' => $projectId])->toArray($exclude=['members']); 
        }
        return new JsonResponse($sortedProjects, Response::HTTP_OK);
    }
    
    /**
    * @Route("/api/projects/foryou/{id}", name="for_you_projects", methods={"GET"})
    */
    public function forYouProject($id) : JsonResponse {
        $student = $this->getDoctrine()->getRepository(Student::class)->findOneBy(['id' => $id]);
        $filters = [];
        $domains = $student->getDomains();
        foreach($domains as $domain) {
            $filters['domains'][] = $domain->getName();
        }
        $jobs = $student->getWantedJobs();
        foreach($jobs as $job) {
            $filters['job'][] = $job->getName();
            $filters['jobCategory'][] = $job->getCategory();
        }


        return $this->processAlgorithm($filters);
    }
    
    /**
    * @Route("/api/projects/similar/{id}", name="similar_projects", methods={"GET"})
    */
    public function similarProject($id) : JsonResponse {
        $project = $this->projectRepository->findOneBy(['id' => $id]);
        $filters = [
            'location' => $project->getLocation(),
            'currentPhase' => $project->getCurrentPhase(),
            'asset' => $project->getAsset(),
            'lookingFor' => $project->getLookingFor(),
            'mood' => $project->getMood(),
            'hasImpact' => $project->getHasImpact(),
        ];
        $domains = $project->getDomains();
        foreach($domains as $domain) {
            $filters['domains'][] = $domain->getName();
        }
        $members = $project->getMembers();
        foreach($members as $member) {
            $filters['job'][] = $member->getJob()->getName();
            $filters['jobCategory'][] = $member->getJob()->getCategory();
        }
        return $this->processAlgorithm($filters);
    }
}
