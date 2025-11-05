<?php

if (!function_exists('toNumeric')) {
    /**
     * Convert a mixed value (like "60,000.00" or "AED 5,500") to a clean float.
     */
    function toNumeric($value): float
    {
        if (is_null($value)) {
            return 0.0;
        }

        // Remove commas, currency symbols, and any non-numeric chars except dot and minus
        $cleaned = preg_replace('/[^\d.\-]/', '', $value);

        return (float) $cleaned;
    }
}


function subunitNoGeneration($subUnitData, $key, $i)
{
    // print_r($subUnitData);
    // print_r('increement room no - ' . $i);
    if (isset($subUnitData['is_partition'][$key])) {
        if ($subUnitData['is_partition'][$key] == '1') {
            $subunitno = 'P' . $i;
        } else if ($subUnitData['is_partition'][$key] == '2') {
            $subunitno = 'BS' . $i;
        }
    } else {
        $subunitno = 'R' . $i;
    }

    return $subunitno;
}
