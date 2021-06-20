<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Job;
use App\Entity\Project;
use App\Repository\ProjectMemberRepository;

class ProjectMemberController {
    private $projectMemberRepository;

    public function __construct(ProjectMemberRepository $projectMemberRepository) {
        $this->projectMemberRepository = $projectMemberRepository;
    }

    /**
     * @Route("/api/projectmembers", name="get_all_projMembers", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $projectMembers = $this->projectMemberRepository->findAll();
        $data = [];
        foreach($projectMembers as $projectMember) {
            $data[] = $projectMember->toArray();
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/projectmembers/{id}", name="get_one_projMember", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $projectMember = $this->projectMemberRepository->findOneBy(['id' => $id]);

        if (empty($projectMembers)) {
            return new JsonResponse(
                ['error' => 'Student with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $projectMember->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/projectmembers", name="create_one_projMember", methods={"POST"})
     */
    public function add(Request $request) : JsonResponse {
        $data = json_decode($request->getContent(), true);
        $jobRepository = $this->getDoctrine()->getRepository(Job::class);
        $projectRepository = $this->getDoctrine()->getRepository(Project::class);

        if (
            !isset($data['jobId']) ||
            !isset($data['detail']) ||
            !isset($data['type']) ||
            !isset($data['retribution']) ||
            !isset($data['projectId'])
        ) {
            return JsonResponse(
                ['error' => 'Missing mandatory fields'],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $job = $jobRepository->findOneBy(['id' => $data['jobId']]);
        $detail = $data['detail'];
        $type = $data['type'];
        $retribution = $data['retribution'];
        $project = $projectRepository->findOneBy(['id' => $data['projectId']]);
        $isFree = true;

        $projectMember = $this->projectMemberRepository->saveProjectMember(
            $job,
            $project,
            $type,
            $detail,
            $retribution,
            $isFree
        );

        $data = $projectMember->toArray();
        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/projectmembers/{id}", name="remove_one_projMember", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $projectMember = $this->projectMemberRepository->findOneBy(["id" => $id]);
        $this->projectMemberRepository->removeStudent($student);
        return new JsonResponse(
            ["status" => "Student deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/projectmembers/{id}", name="update_one_projMember", methods="PUT")
     */
    public function update($id, Request $request) : JsonResponse {
        $projectMember = $this->projectMemberRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        if(isset($data['jobId'])) {
            $projectMember->setJob($this->projectMemberRepository->findOneBy(["id" => $id]));
        } 
        isset($data['type']) ? $projectMember->setType($data['type']) : true;
        isset($data['detail']) ? $projectMember->setDetail($data['detail']) : true;
        isset($data['retribution']) ? $projectMember->setRetribution($data['retribution']) : true;
        isset($data['isFree']) ? $projectMember->setIsFree($data['isFree']) : true;
    
        $updatedProjectMember = $this->projectMemberRepository->update($projectMember);

        return new JsonResponse($updatedProjectMember->toArray(), Response::HTTP_OK);
    }
}