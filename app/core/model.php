<?php

namespace App\Core;

class Model {
  protected $massAssignable = [];

  public function fromArray(array $data)
  {
    foreach ($data as $key => $value) {
      if(in_array($key, $this->massAssignable)) {
        $this->$key = $value;
      }
    }
  }
}
