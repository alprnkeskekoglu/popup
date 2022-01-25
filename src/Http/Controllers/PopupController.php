<?php

namespace Dawnstar\Popup\Http\Controllers;

use Dawnstar\Popup\Http\Requests\PopupRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PopupController extends Controller
{
    public function index()
    {
        $popups = collect();
        return view('Popup::index', compact('popups'));
    }

    public function create()
    {
        return view('Popup::create');
    }

    public function store(PopupRequest $request)
    {
        dd($request->all());
    }

}
