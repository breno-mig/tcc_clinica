<?php
namespace App\Commun\Helper;
trait stringHelper
{
    public function clear_string($string): string
    {
        return preg_replace('/[^[:alnum:] a-zÀ-ú]/', '', $string);
    }
}