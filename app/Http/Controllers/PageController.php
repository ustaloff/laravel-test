<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Show the form for creating a new link.
     * Store a newly created link.
     * Display a created link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'link' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('/')->withErrors($validator, 'link');
            }
        } else {
            return view('index');
        }

        $data['link'] = $request->input('link');

        while (true) {
            $shuffle_str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $data['short_link'] = substr(str_shuffle($shuffle_str), 0, 4);
            
            if (!Page::where('short_link', '=', $data['short_link'])->exists()) {
                Page::create($data);
                break;
            }
        }

        return view('index', ['link' => $data['short_link']]);
    }
}
