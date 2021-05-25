<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Domain;
use App\Entity\Job;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        ## begin of domain fixtures
        $domains = [
            "Alimentaire",
            "Audiovisuel",
            "Bien-être & Sport",
            "Cosmétique",
            "Culture",
            "Deeptech",
            "Digital",
            "Divertissement",
            "Économie",
            "Environnement",
            "Évènementiel",
            "Hôtellerie",
            "Ingénieurie",
            "Jeux vidéos",
            "Luxe",
            "Marketing & Comm",
            "Mobilité",
            "Mode",
            "Musique",
            "Restauration",
            "Santé",
            "Sciences humaines",
            "Social",
            "Technologie",
            "Transport",
            "Urbanisme"
        ];
        foreach($domains as $domainName) {
            $domain = new Domain();
            $domain->setName($domainName);
            $manager->persist($domain);
        };
        ## end of domain fixtures

        ## begin of job fixtures

        $jobs = [

            "Développeur.se Cybersécurité" => "Développement",
            "Développeur.se Gaming" => "Développement",
            "Développeur.se Mobile" => "Développement",
            "Développeur.se Web" => "Développement",
            "Technicien.ne Réseau" => "Développement",
            "Tech Lead" => "Développement",

            "Designer Industriel" => "Industriel",
            "Ingénieur Industriel" => "Industriel",

            "Animateur 2D/3D" => "Design",
            "Directeur.rice Artistique" => "Design",
            "Graphiste" => "Design",
            "Illustrateur.rice" => "Design",
            "Ingénieur.e Son & Lumière" => "Design",
            "Monteur.rice" => "Design",
            "Photographe" => "Design",
            "UX/UI designer" => "Design",
            "Réalisateur.rice" => "Design",
            "Styliste" => "Design",
            "Vidéaste" => "Design",

            "Business Développeur.se" => "Management",
            "Chargé.e de Com" => "Management",
            "Chargé.e d’Événements" => "Management",
            "Chargé.e de Marketing" => "Management",
            "Chargé.e de Partenariats" => "Management",
            "Community Manager" => "Management",
            "Expert.e en Référencements" => "Management",
            "Product Manager" => "Management",
            "Project Manager" => "Management",
            "Chargé.e de Relations Presse" => "Management",

            "Comptable" => "Droit",
            "Expert.e en Droit Numérique" => "Droit",
            "Expert.e en Cybersécurité" => "Droit",
            "Expert.e RSE" => "Droit",
            "Juriste" => "Droit",
            "Team Leader" => "Droit",
            "Traducteur.rice" => "Droit",
        ];
        
        foreach($jobs as $jobName => $jobCategory){
            $job = new Job();
            $job->setName($jobName);
            $job->setCategory($jobCategory);
            $manager->persist($job);
        }

        ## end of job fixtures

        $manager->flush();
    }
}
