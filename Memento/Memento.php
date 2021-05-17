<?php

class Memento
{
    /**
     * @var State
     */
    private $state;

    /**
     * @param State $stateToSave
     */
    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    /**
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }
}

class State
{
    const STATE_CREATED = "created";
    const STATE_OPENED = "opened";
    const STATE_ASSINGED = "assinged";
    const STATE_CLOSED = "closed";

    /**
     * @var string
     */
    private $state;
    
    /**
     * @var string[]
     */
    private static $validStates = [
        self::STATE_CREATED,
        self::STATE_OPENED,
        self::STATE_ASSINGED,
        self::STATE_CLOSED,
    ];

    /**
     * @param string $state
     */
    public function __construct(string $state)
    {
        self::ensureIsVaildState($state);
        $this->state = $state;
    }

    private static function ensureIsVaildState(string $state)
    {
        if( !in_array($state,self::$validStates) ){
            throw new \InvalidArgumentException('Invalid state given');
        }
    }

    public function __toString():string
    {
        return $this->state;
    }
}

class Ticket
{
    /**
     * @var State
     */
    private $cuttentState;
    
    public function __construct()
    {
        $this->currentState = new State(State::STATE_CREATED);
    }
    
    public function open()
    {
        $this->cuttentState = new State(State::STATE_OPENED);
    }

    public function assign()
    {
        $this->currentState = new State(State::STATE_OPENED);
    }

    public function close()
    {
        $this->cuttentState = new State(State::STATE_CLOSED);
    }

    public function saveToMemento():Memento
    {
        return new Memento(clone $this->cuttentState);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->currentState = $memento->getState();
    }

    public function getState():State
    {
        return $this->currentState;
    }
}

$ticket = new Ticket();

echo "<pre>";

$ticket->open();

var_dump(
    $ticket->getState()
);

$memento = $ticket->saveToMemento();

$ticket->assign();

var_dump(
    $ticket->getState()
);

$ticket->restoreFromMemento($memento);

var_dump(
    $ticket->getState()
);