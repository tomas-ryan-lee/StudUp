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

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function toArray(array $exclude = []) {
        $data = [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "type" => $this->getType()
        ];
        foreach($exclude as $key) {
            unset($data[$key]);
        }
        return $data;
    }
}
