<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'contact.';

    public function index()
    {
        $data = Helper::readJSONData($this->folder . 'json');

        return view($this->prefix . $this->folder . 'index', compact('data'));
    }
}
