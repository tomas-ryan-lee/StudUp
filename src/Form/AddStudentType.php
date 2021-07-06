<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use App\Entity\Job;
use App\Entity\Domain;


class AddStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class, ["label" => "Prénom"])
            ->add('name', TextType::class, ["label" => "Nom"])
            ->add('gender', ChoiceType::class, ["choices" => [
                "Homme" => "Homme",
                "Femme" => "Femme",
            ], "label" => "Tu es ?"])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text', 
                "label" => "Date de naissance",
            ])
            ->add('school', TextType::class, ["label" => "Ton école"])
            ->add('study_level', ChoiceType::class, ["choices" => [
                "BAC" => "BAC",
                "Bachelor" => "Bachelor",
                "BEP" => "BEP",
                "BTS" => "BTS",
                "CAP" => "CAP",
                "Classes prépa" => "Classes prépa",
                "DEUG" => "DEUG",
                "DEUST" => "DEUST",
                "Diplôme d'ingénieur" => "Diplôme d'ingénieur",
                "Doctorat" => "Doctorat",
                "DUT" => "DUT",
                "Licence" => "Licence",
                "Maîtrise" => "Maîtrise",
                "Master" => "Master",
            ], "label" => "Diplôme"])
            ->add('graduation_year', ChoiceType::class, ["choices" => [
                "2026" => "2026",
                "2025" => "2025",
                "2024" => "2024",
                "2023" => "2023",
                "2022" => "2022",
                "2021" => "2021",
                "2020" => "2020",
                "2019" => "2019",
                "2018" => "2018",
                "2017" => "2017",
                "2016" => "2016",
                "2015" => "2015",
                "2014" => "2014",
                "2013" => "2013",
                "2012" => "2012",
                "2011" => "2011",
                "2010" => "2010",
                "2009" => "2009",
                "2008" => "2008",
                "2007" => "2007",
                "2006" => "2006",
                "2005" => "2005",
            ], "label" => "Année"])
            ->add('school_name', TextType::class, ["label" => "Nom du cursus de ton école"])
            //Onglet 2
            ->add('skills', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name',
                'label' => "Ce que tu sais faire",
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('domains', EntityType::class, [
                'class' => Domain::class,
                'choice_label' => 'name',
                'label' => 'Ce qui te fait vibrer',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('contact', ChoiceType::class, ["choices" => [
                "On te contacte ?" => true,
                "On ne te contacte pas" => false,
            ], "label" => false])
            ->add('bio', TextareaType::class, ["label" => "C'est à toi de jouer ! Parle du type de missions que tu recherches"])
            //Onglet 3
            ->add('phone', TelType::class, ["label" => "Téléphone (Facultatif)"])
            ->add('social', ChoiceType::class, ["choices" => [
                "Facebook" => "Facebook",
                "LinkedIn" => "LinkedIn",
            ], "label" => "Diplôme"])
            ->add('social_url', UrlType::class, ["label" => "Réseau social (Facultatif)"])
            ->add('email', EmailType::class, ["label" => "Je jure solenellement que mes intentions sont bonnes"])
            ->add('password', PasswordType::class, ["label" => "Mot de passe"])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'J\'accepte les conditions générales d\'utilisation'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, ["label" => "Créer mon compte"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
