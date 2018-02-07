<?php // src/Entity/Subject.php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Subject
{
    /**
     * @Assert\NotBlank()
     */
    protected $name;
    /**
     * @Assert\Url()
     */
    protected $image;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image = '')
    {
        $this->images = $image;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'image' => $this->image
        ];
    }
}
