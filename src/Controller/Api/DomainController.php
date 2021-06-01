<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\DomainRepository;


class DomainController {
    private $domainRepository;

    public function __construct(DomainRepository $domainRepository) {
        $this->domainRepository = $domainRepository;
    }

    /**
     * @Route("/api/domains", name="get_all_domains", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $domains = $this->domainRepository->findAll();
        $data = [];
        foreach($domains as $domain) {
            $data[] = [
                'id' => $domain->getId(),
                'name' => $domain->getName(),
                'category' => $domain->getCategory()
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }
    

    /**
     * @Route("/api/domains/{id}", name="get_one_domain", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $domain = $this->domainRepository->findOneBy(['id' => $id]);

        if(empty($domain)) {
            return new JsonResponse(
                ['error' => 'Domain with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $domain->toArray();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/domains", name="create_one_domain", methods={"POST"})
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
            
        $domain = $this->domainRepository->saveDomain($name, $category);
        $data = $domain->toArray();
        return new JsonResponse(
            $data,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/api/domains/{id}", name="delete_one_domain", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $domain = $this->domainRepository->findOneBy(["id" => $id]);
        $this->domainRepository->removeDomain($domain);
        return new JsonResponse(
            ["status" => "Domain deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/domains/{id}", name="update_one_domain", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $domain = $this->domainRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        isset($data["name"]) ? $domain->setName($data["name"]) : true;
        isset($data["category"]) ? $domain->setCategory($data["category"]) : true;

        $updatedDomain = $this->domainRepository->updateDomain($domain);

        return new JsonResponse($updatedDomain->toArray(), Response::HTTP_OK);

    }
}
