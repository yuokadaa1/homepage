<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExecController extends Controller{

  public function executePython(Request $request) {
      $current = "\\[PATH]\\[TO]\\[EXECUTE_PROGRAM]\\";
      $path = $current . "sample.py " . $current;
      $command = "python " . $path;
      dd($path);
      exec($command, $output);
  }

}
