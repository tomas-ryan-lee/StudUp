<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Domain;
use App\Entity\Job;
use App\Entity\Project;
use App\Entity\School;
use App\Repository\StudentRepository;

class StudentController {
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @Route("/api/students", name="get_all_students", methods={"GET"})
     */
    public function getAll() : JsonResponse {
        $students = $this->studentRepository->findAll();
        $data = [];
        foreach($students as $student) {
            $data[] = $student->toArray($exclude=['favorites']);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/students/{id}", name="get_one_student", methods={"GET"})
     */
    public function get($id) : JsonResponse {
        $student = $this->studentRepository->findOneBy(['id' => $id]);

        if(empty($student)) {
            return new JsonResponse(
                ['error' => 'Student with id '.$id.' not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $student->toArray($exclude=['favorites']);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/students", name="create_one_student", methods={"POST"})
     */
    public function add(Request $request) : JsonResponse {
        $data = json_decode($request->getContent(), true);
        $schoolRepository = $this->getDoctrine()->getRepository(School::class);
        $domainRepository = $this->getDoctrine()->getRepository(Domain::class);
        $jobRepository = $this->getDoctine()->getRepository(Job::class);

        if(
            !isset($data['status']) ||
            !isset($data['surname']) ||
            !isset($data['name']) ||
            !isset($data['gender']) ||
            !isset($data['birthday']) ||
            !isset($data['schoolId']) ||
            !isset($data['studyLevel']) ||
            !isset($data['graduationYear']) ||
            !isset($data['mail']) ||
            !isset($data['jobIds']) ||
            !isset($data['domainIds']) ||
            !isset($data['newsFrequency']) ||
            !isset($data['profilePic'])
        ) {
            return new JsonResponse(
                ['error' => "Missing mandatory fields"],
                Response::HTTP_NOT_ACCEPTABLE
            );
        };

        $status = $data['status'];
        $surname = $data['surname'];
        $name = $data['name'];
        $gender = $data['gender'];
        $birthday = $data['birthday'];
        $school = $schoolRepository->findOneBy(['id' => $data['schoolId']]);
        $studyLevel = $data['studyLevel'];
        $graduationYear = $data['graduationYear'];
        $mail = $data['mail'];
        $jobs = $jobRepository->findBy(['id' => $data['jobIds']]);
        $domains = $domainRepository->findBy(['id' => $data['domainIds']]);
        $newsFrequency = $data['newsFrequency'];
        $profilePic = $data['profilePic'];

        $studentNumber = isset($data['studentNumber']) ? $data['studentNumber'] : Null;
        $studentCardPic = isset($data['studentCardPic']) ? $data['studentCardPic'] : Null;
        $website = isset($data['website']) ? $data['website'] : Null;
        $linkedin = isset($data['linkedin']) ? $data['linkedin'] : Null;
        $instagram = isset($data['instagram']) ? $data['instagram'] : Null;
        $facebook = isset($data['facebook']) ? $data['facebook'] : Null;
        $user = isset($data['userId']) ? $userRepository->findOneBy(['id' => $data['userId']]): Null;
        $isActif = true;

        $favorites = isset($data['favoriteIds']) ? $projectRepository->findBy(['id' => $data['favoriteIds']]) : Null;

        $student = $this->studentRepository->saveStudent(
            $status,
            $surname,
            $name,
            $gender,
            $birthday,
            $school,
            $studyLevel,
            $graduationYear,
            $studentNumber,
            $studentCardPic,
            $mail,
            $user,
            $jobs,
            $domains,
            $favorites,
            $newsFrequency,
            $profilePic,
            $website,
            $linkedin,
            $instagram,
            $facebook,
            $isActif
        );
        $data = $student->toArray();
        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/students/{id}", name="remove_one_student", methods={"DELETE"})
     */
    public function remove($id) : JsonResponse {
        $student = $this->studentRepository->findOneBy(["id" => $id]);
        $this->studentRepository->removeStudent($student);
        return new JsonResponse(
            ["status" => "Student deleted"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/api/students/{id}", name="update_one_student", methods={"PUT"})
     */
    public function update($id, Request $request) : JsonResponse {
        $student = $this->studentRepository->findOneBy(["id" => $id]);
        $data = json_decode($request->getContent(), true);

        isset($data['status']) ? $student->setStatus($data['status']) : true;
        isset($data['surname']) ? $student->setSurname($data['surname']) : true;
        isset($data['name']) ? $student->setName($data['name']) : true;
        isset($data['gender']) ? $student->setGender($data['gender']) : true;
        isset($data['birthday']) ? $student->setBirthday($data['birthday']) : true;
        if(isset($data['schoolId'])) {
            $student->setSchool($schoolRepository->findOneBy(['id' => $data['schoolId']]));
        }
        isset($data['studyLevel']) ? $student->setStudyLevel($data['studyLevel']) : true;
        isset($data['graduationYear']) ? $student->setGraduationYear($data['graduationYear']) : true;
        isset($data['mail']) ? $student->setMail($data['mail']) : true;
        if(issert($data['jobsId'])) {
            $student->setWantedJobs($jobRepository->findBy(['id' => $jobIds]));
        }
        if(isset($data['domainIds'])) {
            $student->setDomains($domainRepository->findBy(['id' => $domainIds]));
        }
        isset($data['newsFrequency']) ? $student->setNewsFrequency($data['newsFrequency']) : true;
        isset($data['profilePic']) ? $student->setProfilePic($data['profilePic']) : true;

        isset($data['studentNumber']) ? $student->setStuentNumber($data['studentNumber']) : true;
        isset($data['studentCardPic']) ? $student->setStudentCardPic($data['studentCardPic']) : true;
        isset($data['website']) ? $student->setWebsite($data['website']) : true;
        isset($data['linkedin']) ? $student->setLinkedin($data['linkedin']) : true;
        isset($data['instagram']) ? $student->setInstagram($data['instagram']) : true;
        isset($data['facebook']) ? $student->setFacebook($data['facebook']) : true;
        if(isset($data['userId'])) {
            $student->setUser($userRepository->findOneBy(['id' => $data['userId']]));
        }
        $updatedStudent = $this->studentRepository->updateStudent($student);
        if(isset($data['favoriteIds'])) {
            $student->clearFavorites();
            $projectRepository = $this->getDoctrine()->getRepository(Project::class);
            $favorites = $projectRepository->findBy(['id' => $data['favoriteIds']]);
            foreach($favorites as $fav) {
                $student->addFavorite($fav);
            }
        }

        return new JsonResponse($updatedStudent->toArray(), Response::HTTP_OK);
    }
}
