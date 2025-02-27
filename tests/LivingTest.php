<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LivingTest extends TestAbstract
{
    public static function livingDataProvider(): array
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
            'Орк и мёртвый эльф' => [
                'dataTxt' => <<<EOF
                родилась Жронгуэль
                родился Аэорен
                умер Аэорен
                EOF,
                'expectedOutput' => '',
            ],
            'Орк убил эльфа' => [
                'dataTxt' => <<<EOF
                родилась Жронгуэль
                родился Аэорен
                Жронгуэль убила Аэорен
                EOF,
                'expectedOutput' => '',
            ],
            'Не все эльфы умерли' => [
                'dataTxt' => <<<EOF
                родился Аэбер
                родился Эонерил
                родился Ктыгрузд
                умер Эонерил
                Ктыгрузд убил Аэбер
                родилась Гилаора
                родился Улиефаэль
                Гилаора убила Ктыгрузд
                родился Вилоурефаэль
                родился Дрыгбрузж
                EOF,
                'expectedOutput' => <<<EOF
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
            'Эльф родился и умер' => [
                'dataTxt' => <<<EOF
                родился Аэорен
                умер Аэорен
                EOF,
                'expectedOutput' => '',
            ],
            'Один орк' => [
                'dataTxt' => <<<EOF
                родился Нурглабр
                EOF,
                'expectedOutput' => '',
            ],
            'Орк родился и умер' => [
                'dataTxt' => <<<EOF
                родился Нурглабр
                умер Нурглабр
                EOF,
                'expectedOutput' => '',
            ],
            'Однофамилец' => [
                'dataTxt' => <<<EOF
                родился Аэрон
                родилась Брумгильда
                Брумгильда убила Аэрон
                родился Аэрон
                EOF,
                'expectedOutput' => <<<EOF
                Аэрон
                EOF,
            ],
        ];
    }

    #[DataProvider('livingDataProvider')]
    public function testLiving(string $dataTxt, string $expectedOutput): void
    {
        $this->cliExecAndAssert(__DIR__ . '/../living.php', $dataTxt, [], $expectedOutput);
    }
}
