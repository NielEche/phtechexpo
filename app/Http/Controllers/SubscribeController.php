<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subscribers;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {

        subscribers::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'That worked, we will be in touch !');
    }
}
