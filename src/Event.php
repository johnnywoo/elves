<?php

class Event
{
    /**
     * @param string[] $arguments
     */
    public function __construct(
        public array $arguments,
    )
    {
    }

    public static function create(array $arguments): self
    {
        return new Event($arguments);
    }
}
