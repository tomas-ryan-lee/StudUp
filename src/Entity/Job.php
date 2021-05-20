<?php

namespace App\Entity;
use Doctrine\ORM\Mappinga as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="job")
 */
class Job{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $category;
}
