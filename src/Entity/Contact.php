<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank
     * @Assert\Email
     */
    public $sender;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=20)
     */
    public $subject;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     */
    public $message;

}