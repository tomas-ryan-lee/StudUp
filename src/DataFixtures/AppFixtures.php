<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Domain;
use App\Entity\Job;
use App\Entity\Project;
use App\Entity\School;
use App\Entity\Student;
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
        $i = 0;
        foreach($domains as $domainName) {
            $domain = new Domain();
            $domain->setName($domainName);
            $manager->persist($domain);

            $this->addReference("domain".$i, $domain);
            $i++;
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
        $i = 0;
        foreach($jobs as $jobName => $jobCategory){
            $job = new Job();
            $job->setName($jobName);
            $job->setCategory($jobCategory);
            $manager->persist($job);

            $this->addReference("job".$i, $job);
            $i++;
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
        $i = 0;
        foreach($commerce as $commerceSchool) {
            $school = new School();
            $school->setName($commerceSchool);
            $school->setType("Commerce");
            $manager->persist($school);

            $this->addReference("school".$i, $school);
            $i++;
        };

        ## end of school fixtures

        ## begin of user fixtures (without relations)

        $users = [
            "user1@example.com" => "password",
            "user2@example.com" => "1234",
            "jordan.kevin57@gmail.com" => "YourReallyToughtIWouldPutMyPassword?"

        ];
        $i = 0;
        foreach($users as $login => $password) {
            $user = new User();
            $user->setLogin($login);
            $user->setPassword($password);
            $manager->persist($user);

            $this->addReference("user".$i, $user);
            $i++;
        };

        ## end of user fixtures

        ## begin of student fixtures (without relations)

        $students = [
            [
                "student",
                "Jules",
                "Patapon",
                "other",
                "2018-07-14",
                "Bac +0",
                2020,
                "user1@example.com",
                "daily",
                "example.com",
                False
            ], [
                "student",
                "Florine",
                "Bonnin",
                "female",
                "1996-02-14",
                "Bac +2",
                2016,
                "user2@example.com",
                "weekly",
                "example.com",
                True
            ], [
                "alumni",
                "Kévin",
                "Jordan",
                "male",
                "1996-03-15",
                "Bac +5",
                2020,
                "jordan.kevin57@gmail.com",
                "monthly",
                "racontard.fr",
                True
            ]
        ];
        $i = 0;
        foreach($students as list(
            $status,
            $surname,
            $name,
            $gender,
            $birthday,
            $studyLevel,
            $graduationYear,
            $mail,
            $newsFrequency,
            $website,
            $isActif
        )) {
            $student = new Student();
            $student->setStatus($status);
            $student->setSurname($surname);
            $student->setName($name);
            $student->setGender($gender);
            $student->setBirthday($birthday);
            $student->setStudyLevel($studyLevel);
            $student->setGraduationYear($graduationYear);
            $student->setMail($mail);
            $student->setNewsFrequency($newsFrequency);
            $student->setWebsite($website);
            $student->setIsActif($isActif);
            $manager->persist($student);

            $this->addReference("student".$i, $student);
            $i++;
        }

        ## end of student fixtures

        ## begin of link for users and students

        for($i=0; $i < 3; $i++) {
            // get student and user
            $student = $this->getReference("student".$i);
            $user = $this->getReference("user".$i);

            // link student and user
            $student->setUser($user);
            $user->setProfile($student);

            // link school to student
            $student->setSchool($this->getReference("school".rand(0, count($commerce)-1)));
            
            // choose 1 to 5 random jobs amoung those stored in DB
            $jobsId = array_rand(range(0, count($jobs)-1), rand(2,5));
            $studentJobs = new ArrayCollection();
            foreach($jobsId as $id) {
                $studentJobs->add($this->getReference('job'.$id));
            }
            $student->setWantedJobs($studentJobs);

            // choose 1 to 5 random jobs amoung those stored in DB
            $domainsId = array_rand(range(0, count($domains)-1), rand(2,5));
            $studentDomains = new ArrayCollection();
            foreach($domainsId as $id) {
                $studentDomains->add($this->getReference('domain'.$id));
            }
            $student->setDomains($studentDomains);
        }

        ## end of link for users and students

        ## begin of project fixtures (without members)

        $projects = [
            [
                "Dummy Project",
                Null,
                "Paris",
                Null,
                "https://www.youtube.com/watch?v=ODKTITUPusM",
                "video",
                "Création de MVP",
                [True, False, True, False, True, False, True, False, True],
                "Lorem ipsum dolor sit amet.",
                "Ceci est un texte random pour remplir le champs qui demandera sans doute plus de place que ce que j'écris ici. Cependant, je n'en ai rien à foutre, je cherche juste à populer la base de données.",
                [],
                ["Rien de particulier", "Inexistant", "Nul"],
                "You talking to my wife?",
                False
            ],
            [
                "You Clothes",
                "racontard.fr",
                "Monaco",
                "/public/img/youclothes.jpg",
                Null,
                "logo",
                "Étude de marché",
                [False, False, False, False, False, False, False, False, False],
                "Une application pour permettre aux gens de scanner les habits et pouvoir s’habiller de manière écologique.",
                "Beaucoup de marques cachent la provenance et/ou les étapes de fabrication de leurs habits, nous voulons proposer aux gens de s’habiller de manière écologique et forcer les marques à créer en harmonie avec la nature. Pour ça nous avons besoin des gens les plus motiver à créer un monde meilleurs et notamment un excellent développeur et un très bon Community manager !",
                ["Associé.e.s"],
                ["Innovant", "Étique", "Impact environnemental", "Ambitieux"],
                "Netflix & Chill",
                True
            ],
            [
                "Sockart",
                Null,
                "Bordeaux",
                "/public/img/chaussetteArt.png",
                Null,
                "logo",
                "Rédaction du business plan",
                [True, True, True, False, False, False, False, False, False],
                "Nos chaussettes mettent les musées à vos pieds. Des chaussettes, un tableaux et une fiche qui t’apprend son histoire!",
                "Une entreprise francaise de chaussettes 100% en coton issus de l’agriculture biologique, qui remet l’art au coeur de votre vie. Ces supers chaussettes, à l’éffigie des plus celebres tableaux du monde, vous seront livré avec de superbes annectodes sur le peintre et l’histoire du tableau, pour briller en société.\n N’hésitez plus, venez prendre votre pied avec l’art !",
                ["Associé.e.s", "Collaborateur.rice.s"],
                ["Savoir faire", "Didactique", "Inventif", "International"],
                "Réunionite aigüe",
                False
            ],
        ];
        $i = 0;
        foreach($projects as list(
            $name,
            $incubator,
            $location,
            $logo,
            $video,
            $display,
            $currentPhase,
            $phases,
            $globalVision,
            $elevatorSpeech,
            $asset,
            $lookingFor,
            $mood,
            $impact
        )) {
            $project = new Project();
            $project->setName($name);
            $project->setIncubator($incubator);
            $project->setLocation($location);
            $project->setLogo($logo);
            $project->setVideo($video);
            $project->setDisplayedContent($display);
            $project->setCurrentPhase($currentPhase);
            $project->setPhases($phases);
            $project->setGlobalVision($globalVision);
            $project->setElevatorSpeech($elevatorSpeech);
            $project->setAsset($asset);
            $project->setLookingFor($lookingFor);
            $project->setMood($mood);
            $project->setHasImpact($impact);

            $domainsId = array_rand(range(0, count($domains)-1), rand(2,5));
            $projectDomains = new ArrayCollection();
            foreach($domainsId as $id) {
                $projectDomains->add($this->getReference('domain'.$id));
            }
            $project->setDomains($projectDomains);

            $manager->persist($project);

            $this->addReference("project".$i, $project);
            $i++;

        }

        ## end of project fixtures

        $manager->flush();
    }
}
