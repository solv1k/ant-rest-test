<?php

namespace App\Http\Controllers;

use App\Models\Stream;

class DashboardController extends RestApiController
{
    public function index()
    {
        // постранично получаем стримы из БД
        $streams = Stream::paginate(5);

        return view('dashboard', compact('streams'));
    }
}
