<?php

namespace App\Core;

class BaseUrl
{
  public function detectBaseUrl()  {
    return sprintf(
      "%s://%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME']
    );
  }
}

?>
