<?php

require_once __DIR__ . '/vendor/autoload.php';

$dataset = $_SERVER['argv'][1] ?? __DIR__ . '/data/basic.txt';
$events = EventLoader::fromFile($dataset);

// Показываем список эльфов.
foreach ($events as $event) {
    if (in_array(strtolower($event->arguments[0]), ['родился', 'родилась'])) {
        echo $event->arguments[1] . "\n";
    }
}
