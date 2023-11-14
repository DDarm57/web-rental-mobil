<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Home Admin'
        ];

        return view('home', $data);
    }
}
