<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class MoveEvent extends Event{

    /**
     * @var string
     */
    private $action;

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }




}