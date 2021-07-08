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

    public function setCategory(?string $category) {
        $this->category = $category;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function toArray(array $exclude = []) {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'category' => $this->getCategory()
        ];
        foreach($exclude as $key) {
            unset($data[$key]);
        }
        return $data;
    }
}
