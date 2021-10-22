<?php

namespace App;

class CalculateRectangles
{
    const COLUMN = 2;
    const LINE = 2;

    /**
     * @var int
     */
    protected int $allFigures = 0;

    public function run(): void
    {
        $allRectangles = 0;
        for ($column = 1; $column <= self::COLUMN; $column++) {
            $rectanglesInLine = 0;
            for ($line = 1; $line <= self::LINE; $line++) {
                $rectanglesInLine += $line;
            }
            $allRectangles += $rectanglesInLine * $column;
        }

        echo $allRectangles;
    }
}