<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* Onglet 1
            --------------------------------------------------------------*/
            ->add('skills_wish', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name',
                'label' => "Compétences recherchées",
            ])

            /* Onglet 2
            --------------------------------------------------------------*/
            ->add('project_name', TextType::class, ["label" => "Nom du projet"])
            ->add('domains', EntityType::class, [
                'class' => Domain::class,
                'choice_label' => 'name',
                'label' => "Secteur d'activité",
            ])
            ->add('localization', ChoiceType::class, ["choices" => [
                "Paris" => "Paris",
                "Marseille" => "Marseille",
                "Toulouse" => "Toulouse",
                "Nice" => "Nice",
                "Nantes" => "Nantes",
                "Toulouse" => "Toulouse",
                "Nice" => "Nice",
                "Nantes" => "Nantes",
                "Montpellier" => "Montpellier",
                "Strasbourg" => "Strasbourg",
            ], "label" => "Localisation"])
            ->add('sparring', ChoiceType::class,
            ["choices" => 
                [
                    "Oui" => true,
                    "Non" => false,
                ], 
                "label" => "Es-tu accompagné ?",
                "expanded" => true,
            ])
            ->add('video_link', UrlType::class, [
                "label" => "Glisse le lien de ta vidéo de présentation", 
                "required" => false
            ])
            
            /* Onglet 3 
            --------------------------------------------------------------*/
            ->add("vision", TextareaType::class, [
                "label" => "Ta vision globale",
                "min" => 90,
                "max" => 120,
            ])
            ->add("elevator_pitch", TextareaType::class, [
                "label" => "Elevator Pitch",
                "max" => 600,
            ])
            ->add('mood_team' , ChoiceType::class, 
            ["choices" => 
                [
                    "Oui" => true,
                    "Non" => false,
                ], 
                "label" => "Es-tu accompagné ?",
                "expanded" => true,
            ])
            ->add('searching' , ChoiceType::class, ["choices" => [
                "Oui" => true,
                "Non" => false,
            ], "label" => "En recherche de"])
            ->add('atouts', ChoiceType::class, 
            ["choices" => 
                [
                    "Oui" => true,
                    "Non" => false,
                ], 
                "label" => "Atouts du projet",
                "multiple" => true,
                "expanded" => true,
            ])
            ->add('environment' , ChoiceType::class, 
            ["choices" => 
                [
                    "Oui" => true,
                    "Non" => false,
                ], 
                "label" => "Ton projet a-il une vision sociale ou environnementale ?",
                "expanded" => true,
            ])
            
            /* Onglet 4
            --------------------------------------------------------------*/
            ->add("project_phase", ChoiceType::class, ["choices" => [
                "Étude de marché" => 0,
                "Étude des besoins" => 1,
                "Validation du concept" => 2,
                "Rédaction du Business Model" => 3,
                "Création du MPV" => 4,
                "Test du produit / service" => 5,
                "Étude des performances" => 6,
                "Lancement sur le marché" => 7,
                "En activité" => 8,
            ]])
            
            /* Onglet 5
            --------------------------------------------------------------*/
            ->add("collab_name_1", TextType::class, ["label" => false])
            ->add("collab_name_2", TextType::class, ["label" => false])
            ->add("collab_name_3", TextType::class, ["label" => false])

            ->add("collab_type_1", ChoiceType::class, ["choices" => [
                "Associé" => "Associé",
                "Prestataire" => "Prestataire",
                "Consultant.e" => "Consultant.e",
            ]])
            ->add("collab_type_2", ChoiceType::class, ["choices" => [
                "Associé" => "Associé",
                "Prestataire" => "Prestataire",
                "Consultant.e" => "Consultant.e",
            ]])
            ->add("collab_type_3", ChoiceType::class, ["choices" => [
                "Associé" => "Associé",
                "Prestataire" => "Prestataire",
                "Consultant.e" => "Consultant.e",
            ]])

            ->add("collab_desc_1", TextareaType::class, ["label" => "Fiche de poste"])
            ->add("collab_desc_2", TextareaType::class, ["label" => "Fiche de poste"])
            ->add("collab_desc_3", TextareaType::class, ["label" => "Fiche de poste"])
            
            /* Validation
            --------------------------------------------------------------*/
            ->add("submit", SubmitType::class, ["label" => "La suite"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
