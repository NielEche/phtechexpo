<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\Speakers;
use App\Models\Schedules;
use App\Models\EventsMains;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Uploader;
use Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Events::all();
        $eventsMains = EventsMains::all();
        return view('admin.event', ['events' => $events, 'eventsMains' => $eventsMains]);
    }


    public function storeEvent(Request $request)
    {
        $image_url = $request->file('path');
    
        // Handle image upload to Cloudinary if a new image is provided
        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $file = $request->file('path');
            // Define the storage path
            $path = $file->store('uploads', 'public');
            
            if ($path) {
                // Get the URL to the file
                $image_url = Storage::url($path);
            }
        }



        // Create a new feature record in the database
        Events::create([
            'path' => $image_url,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'venue' => $request->input('venue'),
            'theme' => $request->input('theme'),
            'about' => $request->input('about'),
            'publish' => '1',
            // Add more fields as needed
        ]);
        

        // Redirect to a success page or back to the form
        return redirect()->route('admin.events')->with('success', 'Event added successfully');
    }


    public function storeEventsMain(Request $request)
    {
        $image_url = $request->file('path');
    
        // Handle image upload to Cloudinary if a new image is provided
        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $file = $request->file('path');
            // Define the storage path
            $path = $file->store('uploads', 'public');
            
            if ($path) {
                // Get the URL to the file
                $image_url = Storage::url($path);
            }
        }


        // Create a new feature record in the database
        Events::create([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            // Add more fields as needed
        ]);
        

        // Redirect to a success page or back to the form
        return redirect()->route('admin.events')->with('success', 'Details added successfully');
    }


    public function updateEvent(Request $request, $id)
    {
        // Find the HomeIssue record by ID
        $events = Events::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $events->path; // Use the existing image URL by default
    
        // Handle image upload to Cloudinary if a new image is provided
        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $file = $request->file('path');
            // Define the storage path
            $path = $file->store('uploads', 'public');
            
            if ($path) {
                // Get the URL to the file
                $image_url = Storage::url($path);
            }
        }
    
        $publishStatus = $request->has('publish') ? 1 : 0;

        // Update other fields in the record
        $events->update([
            'path' => $image_url,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'venue' => $request->input('venue'),
            'theme' => $request->input('theme'),
            'about' => $request->input('about'),
            'publish' => $publishStatus,
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.events')->with('success', 'Event updated successfully');
    }

    public function updateEventMain(Request $request, $id)
    {
        // Find the HomeIssue record by ID
        $EventsMains = EventsMains::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $EventsMains->path; // Use the existing image URL by default
    
        // Handle image upload to Cloudinary if a new image is provided
        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $path = $request->file('path')->getRealPath();
            $uploadResult = cloudinary()->upload($path);
    
            if ($uploadResult) {
                $image_url = $uploadResult->getSecurePath();
            }
        }
    
        $publishStatus = $request->has('publish') ? 1 : 0;

        // Update other fields in the record
        $EventsMains->update([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.events')->with('success', 'Event Details updated successfully');
    }

    public function destroyEvent($id)
    {
        $events = Events::find($id);

        $events->delete('delete from events where id = ?',[$id]);
        
        $response = [
            "success" => 'Your events has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }


    public function speakerEdit($id)
    {
        $speakers = Speakers::find($id);
    
        if (!$speakers) {
            return redirect()->route('admin.event')->with('error', 'Speaker not found');
        }
    
        return view('admin.editSpeaker', compact('speakers'));
    }



    public function speakers($id)
    {
        $events = Events::find($id);
    
        if (!$events) {
            return redirect()->route('admin.event')->with('error', 'Event not found');
        }
    
        $speakers = Speakers::where('event_id', $id)->orderBy('order_number', 'asc')->get();
    
        return view('admin.speakers', compact('events', 'speakers'));
    }

    
    public function post_order_change(Request $request)
    {
    $data = $request->input('order');
        foreach ($data as $index => $id) {
            Speakers::where('id', $id)->update(['order_number' => $index]);
        }
        return response()->json([
            'message' => 'Speakers Order changed successfully.',
            'alert-type' => 'success'
        ]);
    //return response()->json(['success' => $data]);
    }


    public function schedule($id)
    {
        $events = Events::find($id);
    
        if (!$events) {
            return redirect()->route('admin.event')->with('error', 'Event not found');
        }
    
        $speakers = Speakers::where('event_id', $id)->get();
        $schedules = Schedules::where('event_id', $id)->get();
    
        return view('admin.schedule', compact('events', 'schedules', 'speakers'));
    }
    


    public function storeSpeaker(Request $request)
    {
        $image_url = $request->file('path');
    
        // Handle image upload to Cloudinary if a new image is provided
        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $file = $request->file('path');
            // Define the storage path
            $path = $file->store('uploads', 'public');
            
            if ($path) {
                // Get the URL to the file
                $image_url = Storage::url($path);
            }
        }

        $keynoteStatus = $request->has('keynote') ? 1 : 0;

        // Create a new feature record in the database
        Speakers::create([
            'path' => $image_url,
            'name' => $request->input('name'),
            'profession' => $request->input('profession'),
            'bio' => $request->input('bio'),
            'event_id' => $request->input('event_id'),
            'keynote' => $keynoteStatus,
            'publish' => '1',
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->back()->with('success', 'Speaker added successfully');
    }


    public function storeSchedule(Request $request)
    {
       
        // Create a new feature record in the database
        Schedules::create([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'topic' => $request->input('topic'),
            'venue' => $request->input('venue'),
            'event_id' => $request->input('event_id'),
            'publish' => '1',
            'speaker_id' => $request->input('speaker_id'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->back()->with('success', 'Schedule added successfully');
    }


    public function updateSpeaker(Request $request, $id)
    {
       // Find the HomeIssue record by ID
       $speakers = Speakers::findOrFail($id);
    
       // Initialize the $image_url variable
       $image_url = $speakers->path; // Use the existing image URL by default
   
       // Handle image upload to Cloudinary if a new image is provided
       if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $file = $request->file('path');
            // Define the storage path
            $path = $file->store('uploads', 'public');
            
            if ($path) {
                // Get the URL to the file
                $image_url = Storage::url($path);
            }
        }
        
        $publishStatus = $request->has('publish') ? 1 : 0;
        $keynoteStatus = $request->has('keynote') ? 1 : 0;

        // Update other fields in the record
        $speakers->update([
            'path' => $image_url,
            'name' => $request->input('name'),
            'profession' => $request->input('profession'),
            'bio' => $request->input('bio'),
            'event_id' => $request->input('event_id'),
            'keynote' => $keynoteStatus,
            'publish' => $publishStatus,
            // Add other fields as needed
        ]);
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Speaker updated successfully');
    }



    public function updateSchedule(Request $request, $id)
    {
       // Find the HomeIssue record by ID
       $schedules = Schedules::findOrFail($id);
    
       
        $publishStatus = $request->has('publish') ? 1 : 0;

        // Update other fields in the record
        $schedules->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'venue' => $request->input('venue'),
            'topic' => $request->input('topic'),
            'event_id' => $request->input('event_id'),
            'publish' => $publishStatus,
            'speaker_id' => $request->input('speaker_id'),
            // Add other fields as needed
        ]);
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Schedule updated successfully');
    }



    public function destroySpeaker($id)
    {
        $Speakers = Speakers::find($id);

        $Speakers->delete('delete from Speakers where id = ?',[$id]);
        
        $response = [
            "success" => 'Your Speaker has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }


    public function destroySchedule($id)
    {
        $Schedules = Schedules::find($id);

        $Schedules->delete('delete from Schedules where id = ?',[$id]);
        
        $response = [
            "success" => 'Your Schedules has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }

}
