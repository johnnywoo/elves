# Эльфы и орки

У нас есть летописи событий об орках и эльфах в виде txt файлов.
Мы хотим анализировать эти события разными скриптами и показывать результаты.

## Задание 1

Скрипт elves.php должен показывать список имён эльфов из указанного
файла с событиями (по умолчанию data/elves.txt).

Однако сейчас этот скрипт показывает в том числе и орков.
Нужно это исправить.

Орков от эльфов легко отличить: у эльфов в именах больше гласных, чем согласных.
Мягкие и твёрдые знаки не считаются.

Скрипт запускается так:

    $ php elves.php data.txt

События в txt файле для этого задания бывают только одного вида:
"родился <имя-эльфа>" (и "родилась" как синоним).

Чтобы проверить решение, запустите тесты:

    $ ./vendor/bin/phpunit

## Задание 2

Напишите новый скрипт living.php, который будет показывать,
кто из эльфов остался в живых. Орков показывать не нужно.

Чтобы это определить, нужно учитывать новые виды событий:

- "умер <имя-эльфа>";
- "<имя-орка> убил <имя-эльфа>" — такое событие говорит, что <имя-эльфа> умер.

Для примера в репозитории есть файл data/living.txt.

События в txt файле расположены в хронологическом порядке.

Скрипт должен так же принимать параметр с именем txt файла, как и elves.php.

Чтобы проверить решение, запустите тесты:

    $ ./vendor/bin/phpunit

## Задание 3

Напишите новый скрипт feud.php, который будет показывать,
кому из орков конкретный эльф должен отомстить.

Теперь в событии о рождении могут быть указаны родители:
"родился <имя-эльфа> у <имя-родителя>". Родитель может быть один или несколько.
Форма события "родился <имя-эльфа>" без родителей всё ещё корректна и может встречаться в txt файле.

Эльф должен отомстить всем оркам, которые убили кого-либо из его родственников.
Если орк уже мёртв, ему мстить не надо. Однако в таком случае месть переходит по наследству,
и придётся мстить детям такого орка.

Для примера в репозитории есть файл data/feud.txt.

Скрипт должен запускаться с названием файла и именем эльфа:

    $ php feud.php data/feud.txt Аэбер

Чтобы проверить решение, запустите тесты:

    $ ./vendor/bin/phpunit
