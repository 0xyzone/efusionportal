<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlowchartController extends Controller
{
    public function listing()
    {
        $diagramHtml = '<iframe src="https://draw.io/?<diagram-id>" frameborder="0" width="100%" height="600"></iframe>';
        return View::make('flowcharts.listing', ['diagramHtml' => $diagramHtml]);
    }
}
