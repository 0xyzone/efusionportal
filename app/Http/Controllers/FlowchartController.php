<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FlowchartController extends Controller
{
    public function listing()
    {
        $diagramHtml = '<iframe src="https://app.diagrams.net/?embed=1&ui=atlas&chrome=0&title=Diagram&url=https://drive.google.com/uc?export=download&id=1ozGINa1DCSDYzOIo1C8WuZ3Ry8lV0jSb" frameborder="0" width="100%" height="600"></iframe>';
        return View::make('flowcharts.listing', ['diagramHtml' => $diagramHtml]);
    }
}
