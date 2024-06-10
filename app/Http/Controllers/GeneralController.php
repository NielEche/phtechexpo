<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\Speakers;
use App\Models\Schedules;


use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function about()
    {
        return view('pages.about');
    }
   

    public function events()
    {
        return view('pages.events');
    }
   

    public function schedule()
    {
        return view('pages.schedule');
    }


    public function speakers()
    {
        return view('pages.speakers');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function confirmAttend()
    {
        return view('pages.confirmAttending');
    }


    public function viewSchedule($id)
    {
        $Events = Events::find($id);
    
        if (!$Events) {
            return redirect()->route('pages.events')->with('error', 'Event not found');
        }
    
        $Speakers = Speakers::where('event_id', $id)->orderBy('order_number', 'asc')->get();

        $Schedules = Schedules::where('event_id', $id)->get();
    
        return view('pages.schedule', compact( 'Events', 'Speakers', 'Schedules'));
    }



}
