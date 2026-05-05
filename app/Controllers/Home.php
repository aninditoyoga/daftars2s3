<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->route('reg.form');
    }
}
