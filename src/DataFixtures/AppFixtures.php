<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Domain;
use App\Entity\Job;
use App\Entity\School;
use App\Entity\User;


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

        ## begin of school fixtures

        $commerce = [
            "ISG",
            "ISTEC",
            "ISC",
            "ISG",
            "ESCE",
            "ESUP",
            "ICOGES",
            "ISD",
            "INSEEC",
            "IPAG",
            "PPA",
            "Institut de commerce et de gestion",
            "EBS",
            "ESUP",
            "ESCG",
            "ESCEN",
            "ENC",
            "ESCP",
            "EIMP",
            "PSB",
            "ESGCI",
            "ISCG",
            "KEDGE",
            "Gaming Business School",
            "Euridis",
            "ESG",
            "EDHEC",
            "ESLSCA",
            "IBS",
            "TBS",
            "Moda Domani",
            "Neoma",
            "ESG",
            "MBS",
            "ISC",
            "ESG",
            "ESAM",
            "Weller",
            "EDC",
            "ILCI",
            "IPAG",
            "IFAG",
            "CNPC",
            "ETS",
            "ISCM",
            "EMLV",
            "SKEMA",
            "IFAG",
            "ISEG",
            "IESIG",
            "HEC",
            "EM Normandie",
            "Ascencia",
            "IÉSEG",
            "ESCE",
            "ESI"
        ];
        foreach($commerce as $commerceSchool) {
            $school = new School();
            $school->setName($commerceSchool);
            $school->setType("Commerce");
            $manager->persist($school);
        };

        ## end of school fixtures

        ## begin of user fixtures (without relations)

        $users = [
            "user1@example.com" => "password",
            "user2@example.com" => "1234",
            "jordan.kevin57@gmail.com" => "YourReallyToughtIWouldPutMyPassword?"

        ];
        foreach($users as $login => $password) {
            $user = new User();
            $user->setLogin($login);
            $user->setPassword($password);
            $manager->persist($user);
        };

        ## end of user fixtures

        $manager->flush();
    }
}
