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
    public static function fromSpec(string $spec): array
    {
        $events = [];
        $spec = str_replace(';', "\n", $spec);
        foreach (explode("\n", $spec) as $line) {
            $line = trim($line);
            if ($line == '') {
                continue;
            }
            $parts = preg_split('/\s+/', $line);
            if (count($parts) < 2) {
                throw new Exception('Bad spec: ' . $line);
            }
            $events[] = Event::create($parts);
        }
        return $events;
    }
}
