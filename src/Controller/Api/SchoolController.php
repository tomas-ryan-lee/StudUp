<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SchoolRepository;

class SchoolController {
    private $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository) {
        $this->schoolRepository = $schoolRepository;
    }

    /**
     * @Route("/api/schools", name="get_all_schools", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $schools = $this->schoolRepository->findAll();
        $data = [];
        foreach($schools as $school) {
            $data[] = [
                'id' => $school->getId(),
                'name' => $school->getName(),
                'type' => $school->getType()
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/schools/{id}", name="get_one_school", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $school = $this->schoolRepository->findOneBy(["id" => $id]);

        if(empty($school)) {
            return new JsonResponse(
                ['error' => 'School with id '.$id.' not found.'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $school->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/schools", name="school", methods={"POST"})
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

        $school = $this->schoolRepository->saveSchool($name, $category);
        $data = $school->toArray();
        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     *  @Route("/api/schools/{id}", name="delete_one_school", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $school = $this->schoolRepository->findOneBy(["id" => $id]);
        $this->schoolRepository->removeSchool($school);
        return new JsonResponse(
            ["status" => "School deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/schools/{id}", name="update_one_school", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $school = $this->schoolRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        isset($data["name"]) ? $school->setName($data["name"]) : true;
        isset($data["type"]) ? $school->setType($data["type"]) : true;

        $updatedSchool = $this->schoolRepository->updateSchool($school);

        return new JsonResponse($updatedSchool->toArray(), Response::HTTP_OK);
    }
}
