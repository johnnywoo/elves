<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TestAbstract extends TestCase
{
    protected function cliExecAndAssert(string $scriptFile, string $dataTxt, string $expectedOutput): void
    {
        if (!file_exists($scriptFile)) {
            self::markTestSkipped('Скрипт ' . basename($scriptFile) . ' ещё не написан');
        }
        $tmpFile = sys_get_temp_dir() . '/tmp-test-elves.txt';
        file_put_contents($tmpFile, $dataTxt);
        exec(
            'php '
                . escapeshellarg($scriptFile)
                . ' ' . escapeshellarg($tmpFile)
                . ' 2>&1',
            $output,
            $exitCode,
        );
        unlink($tmpFile);
        if ($exitCode) {
            throw new Exception(
                "Тестовый запуск " . basename($scriptFile) . " завершился с ошибкой (exit code {$exitCode})\n"
                    . "Файл с данными:\n{$dataTxt}\n"
                    . "Результат скрипта:\n"
                    . join("\n", $output),
            );
        }
        $output = trim(join("\n", $output));
        self::assertSame(
            "{$expectedOutput}\n",
            "{$output}\n",
            "Тестовый запуск " . basename($scriptFile) . " выдал неправильный результат.\n"
                . "Файл с данными:\n{$dataTxt}"
        );
    }
}
