<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generateID')) {
    function generateID()
    {
        $version =  1;
        $random = base_convert(rand(), 10, 36);
        $unique = uniqid();

        return $unique . $version . $random;
    }
}
