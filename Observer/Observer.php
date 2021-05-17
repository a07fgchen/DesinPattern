<?php

class User implements \SplSubject
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var \SplObjectStorage
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }

    public function notify()
    {
        foreach($this->observers as $observer)
        {
            $observer->update($this);
        }
    }
}

class UserObserver implements \SplObserver
{
    /**
     * @var User[]
     */
    private $changedUsers = [];

    /**
     * 他通常使用SplSubject::notify 通知主體
     * 
     * @param \SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        $this->changedUsers[] = clone $subject;
    }
    
    /**
     * @return User[]
     */
    public function getChangedUsers():array
    {
        return $this->changedUsers;
    }
}

$observer = new UserObserver();

$user = new User();
$user->attach($observer);

$user->changeEmail('foo@bar.com');

echo "<pre>";

var_dump($user);

var_dump($observer->getChangedUsers());