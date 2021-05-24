<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="school")
 */
class School {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;
    # marketing, IT, electronic, ...
    /**
     * @ORM\Column(type="string")
     */
    private $type;


    public function setName(string $name) {
        $this->name = $name;
    }

    public function setType(string $type) {
        $this->type = $type;
    }
}
