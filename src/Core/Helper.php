<?php

namespace App\Core;

class Helper
{
public static function dd($some)
{
    echo '<pre>';
    print_r($some);
    echo '</pre>';
    exit();
}
public static function goToUrl($url)
{
    echo "<script> window.location.href = '$url';</script>";
}
}