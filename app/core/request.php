<?php

namespace App\Core;

class Request {
  public $inputs = [];
  public $files = [];

  public function __construct() {
    foreach($_GET as $key=>$val) {
      $this->inputs[$key] = $val;
    }
    foreach ($_POST as $key=>$val) {
      $this->inputs[$key] = $val;
    }

    $this->files = $_FILES;
  }

  public function input($key)
  {
    if(!empty($this->inputs[$key]))
    {
      return $this->inputs[$key];
    }
    return null;
  }

  public function file($name)
  {
    return $this->files[$name];
  }
}

?>
