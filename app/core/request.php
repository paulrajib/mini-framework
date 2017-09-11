<?php

namespace App\Core;

class Request {
  public $inputs = [];

  public function __construct() {
    foreach($_GET as $key=>$val) {
      $this->inputs[$key] = $val;
    }
    foreach ($_POST as $key=>$val) {
      $this->inputs[$key] = $val;
    }
  }

  public function input($key)
  {
    if(!empty($this->inputs[$key]))
    {
      return $this->inputs[$key];
    }
    return null;
  }
}

?>
