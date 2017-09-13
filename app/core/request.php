<?php

namespace App\Core;

class Request {
  public $inputs = [];
  public $files = [];
  public $jsonData = [];

  public function __construct() {
    foreach($_GET as $key=>$val) {
      $this->inputs[$key] = $val;
    }
    foreach ($_POST as $key=>$val) {
      $this->inputs[$key] = $val;
    }
    $this->jsonData = $this->parseJsonData();
    $this->files = $_FILES;
  }

  public function parseJsonData()
  {
    $postdata = file_get_contents("php://input");
    $dataObj = json_decode($postdata, true);
    return $dataObj;
  }

  public function getJsonData($key)
  {
    if(!empty($this->jsonData[$key]))
    {
      return $this->jsonData[$key];
    }
    return null;
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
