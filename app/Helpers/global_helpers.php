<?php

// Convert minutes to hours and minutes

if (!function_exists('minutesToTime')) {

    /**
     * Converts minutes to hours and minutes.
     *
     * @param int $minutes
     * @return string
     *
     * @example minutesToTime(90) "1h 30min"
     */
    function minutesToTime(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        if ($hours < 1) {
            return sprintf('%d min', $minutes);
        }

        return sprintf('%d h %d min', $hours, $minutes);
    }
}
