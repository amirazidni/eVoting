<?php

if (!function_exists('generateID')) {
    function generateID()
    {
        $time = uniqid();
        $random = base_convert(rand(), 10, 36);
        return $time . '-' . $random;
    }
}
