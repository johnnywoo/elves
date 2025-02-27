<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TestAbstract extends TestCase
{
    protected function cliExecAndAssert(
        string $scriptFile,
        string $dataTxt,
        array $scriptArgs,
        string $expectedOutput,
    ): void
    {
        if (!file_exists($scriptFile)) {
            self::markTestSkipped('Скрипт ' . basename($scriptFile) . ' ещё не написан');
        }
        $tmpFile = sys_get_temp_dir() . '/tmp-test-elves.txt';
        file_put_contents($tmpFile, $dataTxt);
        $args = [$tmpFile, ...$scriptArgs];
        exec(
            'php '
                . escapeshellarg($scriptFile)
                . ' ' . join(' ', array_map('escapeshellarg', $args))
                . ' 2>&1',
            $output,
            $exitCode,
        );
        unlink($tmpFile);
        if ($exitCode) {
            throw new Exception(
                "Тестовый запуск " . basename($scriptFile) . " завершился с ошибкой (exit code {$exitCode})\n"
                    . (empty($scriptArgs) ? '' : "Команда: " . basename($scriptFile) . " <txt-file> " . join(' ', $scriptArgs) . "\n")
                    . "Файл с данными:\n{$dataTxt}\n"
                    . "Результат скрипта:\n"
                    . join("\n", $output),
            );
        }
        $expectedOutputLines = explode("\n", $expectedOutput);
        sort($expectedOutputLines);
        $expectedOutput = join("\n", $expectedOutputLines);

        sort($output);
        $output = trim(join("\n", $output));
        self::assertSame(
            "{$expectedOutput}\n",
            "{$output}\n",
            "Тестовый запуск " . basename($scriptFile) . " выдал неправильный результат.\n"
                . (empty($scriptArgs) ? '' : "Команда: " . basename($scriptFile) . " <txt-file> " . join(' ', $scriptArgs) . "\n")
                . "Файл с данными:\n{$dataTxt}"
        );
    }
}
