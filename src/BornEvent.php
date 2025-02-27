<?php

class BornEvent extends Event
{
    public function getName(): string
    {
        return $this->arguments[1];
    }
}
