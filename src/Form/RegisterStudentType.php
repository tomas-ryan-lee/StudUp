<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Modal 1
            ->add('fname', TextType::class)
            ->add('lname', TextType::class)
            ->add("date_birth", DateType::class)
            ->add("gender", ChoiceType::class, [
                "choices" => [
                    "Homme" => "Homme",
                    "Femme" => "Femme",
                    "Ne pas répondre" => "Ne pas répondre"
                ]
            ])
            ->add("mail_adress", EmailType::class)
            ->add("pass", PasswordType::class)
            ->add("photo", FileType::class)
            // Modal 2
            ->add("school", TextType::class)
            ->add("diploma", ChoiceType::class, [
                "choices" => [
                    "BAC" => "BAC",
                    "Bachelor" => "Bachelor",
                    "BEP" => "BEP",
                    "BTS" => "BTS",
                    "CAP" => "CAP",
                    "Classe Prépa" => "Classe Prépa",
                    "DEUG" => "DEUG",
                    "DEUST" => "DEUST",
                    "Diplome d'ingénieur" => "Diplome d'ingénieur",
                    "Doctorat" => "Doctorat",
                    "DUT" => "DUT",
                    "Licence" => "Licence",
                    "Maîtrise" => "Maîtrise",
                    "Master" => "Master"
                ]
            ])
            ->add("diploma", ChoiceType::class, [
                "choices" => [
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
                ]
            ])
            ->add('cursus_name', TextType::class)
            // Modal 3
            ->add("super_powers", ChoiceType::class, [
                "choices" => [
                    "Développeur.se Cybersécurité" => "Développeur.se Cybersécurité",
                ]
            ])
            ->add("favorite_sectors", ChoiceType::class, [
                "choices" => [
                    "Alimentaire" => "Alimentaire",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
        ]);
    }
}
