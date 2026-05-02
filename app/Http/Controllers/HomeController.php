<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function __construct(private readonly LegacyPageController $legacy) {}

    public function index(): Response
    {
        return $this->legacy->show('index.html');
    }
}
