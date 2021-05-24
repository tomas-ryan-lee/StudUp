<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="job")
 */
class Job {
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

    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $category;


    public function setName(string $name) {
        $this->name = $name;
    }

    public function setCategory(string $category) {
        $this->category = $category;
    }
}
