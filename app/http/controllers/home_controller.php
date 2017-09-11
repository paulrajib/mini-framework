<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Request;

class HomeController extends Controller {
  public function __construct()
  {
    parent::__construct();
  }

  public function home(Request $req)
  {
    $this->response->render('home', ['message' => 'This is the homepage']);
  }
}

?>
