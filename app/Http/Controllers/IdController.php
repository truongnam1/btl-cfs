<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdController extends Controller
{
    public function index()
    {
        $mini = round(microtime(true)*1000);
        $second =time();
       echo "m" . $mini . "<br>";
       echo "s" . $second . "<br>";
       echo "date : " .date('d-m-Y H:m:s',8993219088);

    }
}
