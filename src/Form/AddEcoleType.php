<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddEcoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("school_name", TextType::class, ["label" => "Nom de l'école"])
            ->add("school_siret", TextType::class, ["label" => "Numéro de SIRET"])
            ->add('school_formations', ChoiceType::class, [
                "choices" => [
                    "Informatique" => "Informatique",
                    "Marketing" => "Marketing",
                    "Management de projet" => "Management de projet",
                ],
                "multiple" => true,
                "expanded" => true,
                "label_format" => "Domaines de corps de métiers"
            ])
            ->add('school_group_appartenance', ChoiceType::class, [
                "choices" => [
                    "Oui" => 1,
                    "Non" => 0,
                ],
                "expanded" => true,
                "label_format" => "Appartenez vous à un groupe ?"
            ])
            ->add("school_group_name", TextType::class, ["label" => "Si oui, à quel groupe ?", 'required' => false])
            ->add('school_level', ChoiceType::class, [
                "choices" => [
                    "BAC+2" => "BAC+2",
                    "BAC+3" => "BAC+3",
                    "BAC+4" => "BAC+4",
                    "BAC+5" => "BAC+5",
                ],
                "multiple" => true,
                "expanded" => true,
                "label_format" => "Niveau de formation dispensés"
            ])
            ->add("school_campus_nb", NumberType::class, [
                "label" => "Nombre de campus",
                "html5" => true
                ])
            ->add('school_incubateur', ChoiceType::class, [
                "choices" => [
                    "Oui" => 1,
                    "Non" => 0,
                ],
                "expanded" => true,
                "label_format" => "Présence d'un incubateur"
            ])
            ->add("school_nb_students_tot", NumberType::class, [
                "label" => "Nombre d'étudiants total",
                "required" => false,
                "html5" => true
                ])
            ->add("school_nb_students_plateform", NumberType::class, [
                "label" => "Nombre d’étudiant à inscrire sur la plateforme",
                "required" => false,
                "html5" => true
                ])
            ->add("school_intermediary", TextType::class, ["label" => "Nom de l'intermédiaire"])
            ->add("school_intermediary_role", TextType::class, ["label" => "Rôle de l'intermédiaire"])
            ->add("school_intermediary_mail", EmailType::class, ["label" => "E-Mail de l'intermédiaire"])
            ->add("school_intermediary_tel", TelType::class, ["label" => "Téléphone de l'intermédiaire"])
            ->add("submit", SubmitType::class, ["label" => "Envoyer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
