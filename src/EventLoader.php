<?php

class EventLoader
{
    /**
     * @return Event[]
     */
    public static function fromFile(string $file): array
    {
        $contents = file_get_contents($file);
        return self::fromSpec($contents);
    }

    /**
     * @return Event[]
     */
    private static function fromSpec(string $spec): array
    {
        $events = [];
        foreach (explode("\n", $spec) as $line) {
            $line = trim($line);
            if ($line == '') {
                continue;
            }
            $parts = preg_split('/\s+/', $line);
            $events[] = Event::create($parts);
        }
        return $events;
    }
}
