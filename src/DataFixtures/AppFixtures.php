<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Domain;


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

        $manager->flush();
    }
}
