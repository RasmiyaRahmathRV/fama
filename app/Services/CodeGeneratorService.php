<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CodeGeneratorService
{
    /**
     * Generate the next sequential code for any table
     *
     * @param string $table        Table name
     * @param string $column       Column name for code
     * @param string $prefix       Prefix for the code (e.g., ARE, INV)
     * @param int    $padLength    Length of the numeric part (default 3 → 001)
     * @return string
     */
    public function generateNextCode(string $table, string $column, string $prefix, int $padLength = 5, int $addval = 1): string
    {
        $lastCode = DB::table($table)->orderBy('id', 'desc')->value($column);

        if ($lastCode && str_starts_with($lastCode, $prefix)) {
            $number = intval(substr($lastCode, strlen($prefix))) + $addval;
        } else {
            $number = ($addval > 1) ? $addval : 1;
        }

        return $prefix . str_pad($number, $padLength, '0', STR_PAD_LEFT);
    }
}
