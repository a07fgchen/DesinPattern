<?php

namespace Design\DataMappper;

class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $emil;

    public static function formState(array $state): User
    {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

