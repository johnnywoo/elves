<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ElvesTest extends TestCase
{
    public static function elvesDataProvider(): array
    {
        return [
            "Пустой файл" => [
                'dataTxt' => "",
                'expectedOutput' => "",
            ],
            "Один эльф" => [
                'dataTxt' => <<<EOF
                родился Аэорен
                EOF,
                'expectedOutput' => <<<EOF
                Аэорен
                EOF,
            ],
            "Два эльфа" => [
                'dataTxt' => <<<EOF
                родился Аэорен
                родилась Иобулия
                EOF,
                'expectedOutput' => <<<EOF
                Аэорен
                Иобулия
                EOF,
            ],
            "Один орк" => [
                'dataTxt' => <<<EOF
                родился Нурглабр
                EOF,
                'expectedOutput' => '',
            ],
        ];
    }

    #[DataProvider('elvesDataProvider')]
    public function testElves(string $dataTxt, string $expectedOutput): void
    {
        $tmpFile = sys_get_temp_dir() . '/tmp-test-elves.txt';
        file_put_contents($tmpFile, $dataTxt);
        exec(
            'php '
                . escapeshellarg(__DIR__ . '/../elves.php')
                . ' ' . escapeshellarg($tmpFile)
                . ' 2>&1',
            $output,
            $exitCode,
        );
        if ($exitCode) {
            throw new Exception(
                "Тестовый запуск elves.php завершился с ошибкой (exit code {$exitCode})\n"
                    . "Файл с данными:\n{$dataTxt}\n"
                    . "Результат скрипта:\n"
                    . join("\n", $output),
            );
        }
        $output = trim(join("\n", $output));
        self::assertSame(
            $expectedOutput,
            $output,
            "Тестовый запуск elves.php выдал неправильный результат.\n"
                . "Файл с данными:\n{$dataTxt}"
        );
    }
}
