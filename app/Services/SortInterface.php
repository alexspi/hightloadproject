<?php
/**
 * Created by PhpStorm.
 * User: Aleksei Butenko
 * Date: 22.09.2022
 * Time: 17:16
 */

namespace App\Services;

interface SortInterface
{
    public function sort(array $inputArray): array;
}