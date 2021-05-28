<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\JobRepository;


class JobController {
    private $jobRepository;

    public function __construct(JobRepository $jobRepository) {
        $this->jobRepository = $jobRepository;
    }

    /**
     * @Route("/api/jobs", name="get_all_jobs", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $jobs = $this->jobRepository->findAll();
        $data = [];
        foreach($jobs as $job) {
            $data[] = [
                'id' => $job->getId(),
                'name' => $job->getName(),
                'category' => $job->getCategory()
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }
    

    /**
     * @Route("/api/jobs/{id}", name="get_one_job", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $job = $this->jobRepository->findOneBy(['id' => $id]);

        if(empty($job)) {
            return new JsonResponse(
                ['error' => 'Job with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $job->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/jobs", name="create_one_job", methods={"POST"})
     */
    public function add(Request $request) : JsonResponse {
        $data = json_decode($request->getContent(), true);
        if(!isset($data["name"])) {
            return new JsonResponse(
                ["error" => "Missing mandatory parameters"],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $name = $data["name"];
        $category = isset($data["category"]) ? $data["category"] : Null;
            
        $job = $this->jobRepository->saveJob($name, $category);
        $data = $job->toArray();
        return new JsonResponse(
            $data,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/api/jobs/{id}", name="delete_one_job", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $job = $this->jobRepository->findOneBy(["id" => $id]);
        $this->jobRepository->removeJob($job);
        return new JsonResponse(
            ["status" => "Job deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/jobs/{id}", name="update_one_job", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $job = $this->jobRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        isset($data["name"]) ? $job->setName($data["name"]) : true;
        isset($data["category"]) ? $job->setCategory($data["category"]) : true;

        $updatedJob = $this->jobRepository->updateJob($job);

        return new JsonResponse($updatedJob->toArray(), Response::HTTP_OK);

    }
}
