<?php

namespace App\Http;

class Request
{

  public static function get(string $key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }
}
