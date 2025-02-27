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
        if (in_array($arguments[0], ['родился', 'родилась'])) {
            return new BornEvent($arguments);
        }
        throw new Exception('Неизвестный вид события: ' . join(' ', $arguments));
    }
}
