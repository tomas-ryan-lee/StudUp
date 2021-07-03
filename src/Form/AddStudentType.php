<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('student_fname', TextType::class, ["placeholder => Prénom"])
            ->add('student_name', TextType::class, ["placeholder => Nom"])
            ->add('student_gender', ChoiceType::class, ["choices" => [
                "Homme" => "Homme",
                "Femme" => "Femme",
            ], "placeholder" => "Tu es ?"])
            ->add('student_birth', DateType::class, ["placeholder => Date de naissance"])
            ->add('student_school', TextType::class, ["placeholder => Date de naissance"])
            ->add('student_diploma', ChoiceType::class, ["choices" => [
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
            ], "placeholder" => "Diplôme"])
            ->add('student_diploma_year', ChoiceType::class, ["choices" => [
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
            ], "placeholder" => "Année"])
            ->add('Student_school_name', TextType::class, ["placeholder => Nom du cursus de ton école"])
            //Onglet 2
            ->add('student_skills', EntityType::class, [])
            ->add('student_likes', EntityType::class, [])
            ->add('student_contact', ChoiceType::class, ["choices" => [
                "On te contacte ?" => true,
                "On ne te contacte pas" => false,
            ], "placeholder" => "Tu es ?"])
            ->add('student_bio', TextareaType::class, ["placeholder => C'est à toi de jouer ! Parle du type de missions que tu recherches"])
            //Onglet 3
            ->add('student_phone', TelType::class, ["placeholder => Téléphone (Facultatif)"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
