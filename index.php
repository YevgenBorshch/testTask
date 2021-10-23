<?php

// $n - точки по горизонтали
// $m - точки по вертикали
function firstOption(int $n, int $m)
{
    // Для этого метода мне нужно знать сколько колонок и строк.
    // Перевожу количество заданных точек в колонки и строки.
    $allColumns = $n - 1;
    $allLines = $m - 1;
    $allRectangles = 0;

    for ($column = 1; $column <= $allColumns; $column++) {
        $rectanglesInLine = 0;
        for ($line = 1; $line <= $allLines; $line++) {
            $rectanglesInLine += $line;
        }
        $allRectangles += $rectanglesInLine * $column;
    }

    echo '<br>Первый вариант = ' . $allRectangles;
}

/*
 Рисунок для пояснения
   __ __ __ __
A |__|__|__|__|
B |__|__|__|__|
C |__|__|__|__|
D |__|__|__|__|

Суть данного метода состоит в том чтобы разделить подсчет на 2 этапа:

1) найти сколько прямоугольников в одной строке, затем перемножить на количество строк.
Таким образом получим количество "простых" прямоугольников высотой в одну линию.

2) После отдельно считаю сколько "сложных" прямоугольников, состоящих из двух и более строк.
Для этого необходимо просто посчитать количество уникальных комбинаций строк, и перемножить на количество прямоугольников в одной строке.
Например:
 - комбинации строки А - AB, AC, AD - т.е 3 комбинации * 10 (такое количество прямоугольников в одной строке), получаем 30
 - комбинации строки B - BC, BD - т.е 2 комбинации * 10 = 20
 - комбинации строки C - CD - т.е 1 * 10 = 10
Итого: 30 + 20 + 10 = 60 + 40(это количество строк перемноженное на количетсво "простых" прямоугольников) = 100
Для построения кода, который будет "вычислять" количество уникальных комбинаций строк, достаточно из количества строк вычитать по 1.
Например:
 4 - 1 = 3
 3 - 1 = 2
 2 - 1 = 1
При другом количестве точек по горизонтали и вертикали, этот метод тоже работает
*/
function secondOption(int $n, int $m)
{
    $allColumns = $n - 1;
    $allLines = $m - 1;
    $rectanglesInOneLine = 0;

    // Считаю сколько прямоугольников только в одной строке, не считаю прямоугольники состощие из 2х и более строк
    for ($column = 1; $column <= $allColumns; $column++) {
        $rectanglesInOneLine += $column;
    }
    $allSimpleRectangles = $allLines * $rectanglesInOneLine;

    // Считаю количество "уникальных" комбинаций строк
    $linesCombinationCount = 0;
    for ($lines = $allLines - 1;  $lines >= 1; $lines--) {
        $linesCombinationCount += $lines;
    }
    // Количество сложных прямоугольников
    $allComplexRectangles = $linesCombinationCount * $rectanglesInOneLine;

    echo '<br>Второй вариант = ' . ($allComplexRectangles + $allSimpleRectangles);
}

/*
Этот вариант основан на арефметической прогрессии которая присутствует в данной задаче.
Для его работы необходимо чтобы количество точек по горизонтали и вертикали было одинаково.

Прогрессия:
кол-во колонок          1       3       4       5
кол-во прямоугольников  1       9       36      100
закономерность            +2**3   +3**3   +4**3
результат закономерности    8       27      64
*/
function thirdOption(int $n, int $m)
{
    $allColumns = $n - 1;
    $allLines = $m - 1;
    $allRectangles = 0;

    if ($allColumns === $allLines) {
        for ($column = 1; $column <= $allColumns; $column++) {
            $allRectangles += $column ** 3 ;
        }

        echo '<br>Третий вариант = ' . $allRectangles;
    }
}

/*
Последний найденный вариант - уже готовая формула
*/
function fourthOption(int $n, int $m)
{
    $allColumns = $n - 1;
    $allLines = $m - 1;

    echo '<br>Четвертый вариант = ' . (($allColumns * ($allColumns + 1) / 2)) * (($allLines * ($allLines + 1) / 2));
}

// Runner
for ($i = 2; $i <= 9; $i++) {
    echo '<br><b>$N = ' . $i . ' , $M = ' . $i . '</b>';
    firstOption($i, $i);
    secondOption($i, $i);
    thirdOption($i, $i);
    fourthOption($i, $i);
    echo '<br>';
}