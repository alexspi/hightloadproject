<?php

namespace App\Http\Controllers;

use App\Services\BubbleSortInterface;
use App\Services\QuickSortInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SortController extends Controller
{
    private function sortArray($amount, $min, $max): array
    {
        $array = [];
        for($i = 0; $i <= $amount; $i++){
            array_push($array, rand($min,$max));
        }
        return $array;
    }

    public function __construct(
        private QuickSortInterface  $quickSort,
        private BubbleSortInterface $bubbleSort
    )
    {
    }

    public function list()
    {
        try {

            $array = $this->sortArray(200, 1, 10);

            //сортировка
            $timeStart = microtime(true);
            $this->bubbleSort->sort($array);
            $memoryUsage = memory_get_usage();
            Log::channel('sort')->debug('bubbleSort time: ' . round(microtime(true) - $timeStart, 4) . '; memory: ' . $memoryUsage . '   !#$END');

            //Быстрая сортировка
            $timeStart = microtime(true);
            $this->quickSort->sort($array);
            $memoryUsage = memory_get_usage();

            Log::channel('sort')->debug('quickSort time: ' . round(microtime(true) - $timeStart, 4) . '; memory: ' . $memoryUsage . '   !#$END');

        } catch (\Throwable $exception) {
            Log::channel('sort')->debug('Error: ' . $exception . '!#$END');
        }
    }
}