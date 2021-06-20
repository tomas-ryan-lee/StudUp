<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;

class UserController {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/users", name="get_all_userss", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $users = $this->userRepository->findAll();
        $data = [];
        foreach($users as $user) {
            $data[] = $user->toArray();
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/users/{id}", name="get_one_user", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $user = $this->userRepository->findOneBy(['id' => $id]);

        if(empty($user)) {
            return new JsonResponse(
                ['error' => 'User with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $user->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/users", name="create_one_user", methods={"POST"})
     */

    public function add(Request $request) : JsonResponse {
        $data = json_decode($request->getContent(), true);
        if(!isset($data["login"])||!isset($data["password"])) {
            return new JsonResponse(
                ["error" => "Missing mandatory parameters"],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $login = $data["login"];
        $password = $data["password"];
        if(isset($data["studentId"])) {
            // TODO : get the student from the ID
        }
            
        $user = $this->userRepository->saveUser($login, $password, $student);
        $data = $user->toArray();
        return new JsonResponse(
            $data,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/api/users/{id}", name="delete_one_user", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $user = $this->userRepository->findOneBy(["id" => $id]);
        $this->userRepository->removeUser($user);
        return new JsonResponse(
            ["status" => "User deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/users/{id}", name="update_one_user", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $user = $this->userRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        isset($data["login"]) ? $user->setLogin($data["login"]) : true;
        isset($data["password"]) ? $user->setPassword($data["password"]) : true;
        if(isset($data["studentId"])) {
            // TODO : get the student from the ID
        }

        $updatedUser = $this->userRepository->updateUser($user);

        return new JsonResponse($updatedUser->toArray(), Response::HTTP_OK);

    }
}