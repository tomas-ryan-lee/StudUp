<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\User;
use App\Form\AddStudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(): Response
    {
        
        $form = $this->createForm(AddStudentType::class);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $student = new Student();
            $user = new User();

            $user->setLogin($data['email']);
            $user->setPassword($data['password']);
            $user->setRole(['']);
            $user->updateLastConnection();
            $user->setConfirmationUUID(0);

            $student->setName($data['name']);
            $student->setSurname($data['surname']);
            $student->setGender($data['gender']);
            $student->setBirthday($data['birthday']);
            $student->setSchool($data['school']);
            $student->setStudyLevel($data['study_level']);
            $student->setGraduationYear($data['graduation_year']);
            $student->setCursus($data['cursus']);
            //Skills à rajouter
            //Domains à rajouter
            $student->setNewsFrequency($data['contact']);
            //Biographie à rajouter
            if($data['social'] == "Facebook"){
                $student->setFacebook($data['social_url']);
            } elseif($data['social'] == "Instagram"){
                $student->setInstagram($data['social_url']);
            } elseif($data['social'] == "Website"){
                $student->setWebsite($data['social_url']);
            }
            $student->setPhoneNumber($data['phone']);
            $student->setIsActif(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            //On redirige la page vers le formulaire d'ajout de page
            return $this->redirectToRoute('inscription');
        }

        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            'form' => $form->createView(),
        ]);
    }
}
