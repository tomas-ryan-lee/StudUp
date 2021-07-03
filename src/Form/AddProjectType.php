<?php

namespace App\Form;

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
            //Onglet 1
            ->add('project_name', TextType::class, ["label => Nom du projet"])
            ->add('project_domains', ChoiceType::class, ['choices' => [
                'choices' => [
                    "Secteur 1" => "Secteur 1",
                    "Secteur 2" => "Secteur 2",
                ]
            ]])
            ->add('project_local', ChoiceType::class, ['choices' => [
                'choices' => [
                    "Localisation 1" => "Localisation 1",
                    "Localisation 2" => "Localisation 2",
                ]
            ]])
            ->add('project_structure', ChoiceType::class, ['choices' => [
                'choices' => [
                    "Oui" => true,
                    "Non" => false,
                ]
            ]])
            ->add('project_logo', FileType::class, ["label => Logo du projet"])
            ->add('project_video', TextType::class, ["label => Vidéo du projet"])
            //Onglet 2
            ->add("project_vision", TextareaType::class, ["label => Vision globale"])
            ->add("project_elevator_pitch", TextareaType::class, ["label => Elevator Pitch"])
            ->add('project_mood', ChoiceType::class, ['choices' => [
                'choices' => [
                    "Mood 1" => "Mood 1",
                    "Mood 2" => "Mood 2",
                ]
            ]])
            ->add('project_search', ChoiceType::class, ['choices' => [
                'choices' => [
                    "Aide 1" => "Aide 1",
                    "Aide 2" => "Aide 2",
                ]
            ]])
            ->add('project_submit', SubmitType::class, ["label => Envoyer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
