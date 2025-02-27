<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;

class ElvesTest extends TestAbstract
{
    public static function elvesDataProvider(): array
    {
        return [
            'Орк и эльф' => [
                'dataTxt' => <<<EOF
                родилась Жронгуэль
                родился Аэорен
                EOF,
                'expectedOutput' => <<<EOF
                Аэорен
                EOF,
            ],
            'Много народу' => [
                'dataTxt' => <<<EOF
                родился Аэбер
                родился Эонерил
                родился Ктыгрузд
                родилась Гилаора
                родился Улиефаэль
                родился Вилоурефаэль
                родился Дрыгбрузж
                EOF,
                'expectedOutput' => <<<EOF
                Аэбер
                Эонерил
                Гилаора
                Улиефаэль
                Вилоурефаэль
                EOF,
            ],
            'Пустой файл' => [
                'dataTxt' => '',
                'expectedOutput' => '',
            ],
            'Один эльф' => [
                'dataTxt' => <<<EOF
                родился Аэорен
                EOF,
                'expectedOutput' => <<<EOF
                Аэорен
                EOF,
            ],
            'Два эльфа' => [
                'dataTxt' => <<<EOF
                родился Аэорен
                родилась Иобулия
                EOF,
                'expectedOutput' => <<<EOF
                Аэорен
                Иобулия
                EOF,
            ],
            'Один орк' => [
                'dataTxt' => <<<EOF
                родился Нурглабр
                EOF,
                'expectedOutput' => '',
            ],
            'Два орка' => [
                'dataTxt' => <<<EOF
                родилась Жронгуэль
                родился Нурглабр
                EOF,
                'expectedOutput' => '',
            ],
            'Эльф с проблемным именем' => [
                'dataTxt' => <<<EOF
                родилась Уриэль
                EOF,
                'expectedOutput' => <<<EOF
                Уриэль
                EOF,
            ],
            'Орк с проблемным именем' => [
                'dataTxt' => <<<EOF
                родился Петя
                EOF,
                'expectedOutput' => '',
            ],
        ];
    }

    #[DataProvider('elvesDataProvider')]
    public function testElves(string $dataTxt, string $expectedOutput): void
    {
        $this->cliExecAndAssert(__DIR__ . '/../elves.php', $dataTxt, [], $expectedOutput);
    }
}
