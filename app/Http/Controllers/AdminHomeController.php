<?php

namespace App\Http\Controllers;
use App\Models\HomeGallerys;
use App\Models\HomeAbouts;
use App\Models\HomeServices;
use App\Models\HomeVideos;
use App\Models\partners;
use App\Models\User;
use App\Models\programs;
use App\Models\ExplorePrograms;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Uploader;
use Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $homeGallerys = HomeGallerys::all();
        $homeAbouts = HomeAbouts::all();
        $homeServices = HomeServices::all();
        $programs = programs::all();
        $ExplorePrograms = ExplorePrograms::all();
        $HomeVideos = HomeVideos::all();

        return view('admin.index', ['homeGallerys' => $homeGallerys, 'homeAbouts' => $homeAbouts, 'homeServices' => $homeServices,  'programs' => $programs, 'ExplorePrograms' => $ExplorePrograms, 'HomeVideos' => $HomeVideos]);
    }


    public function users()
    {
        $users = User::all(); // Paginate with 20 users per page
    
        return view('admin.users', ['users' => $users]);
    }
    

    public function adminPartner()
    {
        $partners = partners::all();

        return view('admin.partner', ['partners' => $partners]);
    }
 
    

    public function storeImage(Request $request)
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
        HomeGallerys::create([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            'embed' => $request->input('embed'),
            'button' => $request->input('button'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.dashboard')->with('success', 'Image added successfully');
    }

    public function storeHomeServices(Request $request)
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
        HomeServices::create([
            'path' => $image_url,
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.dashboard')->with('success', 'Service added successfully');
    }

    public function storeHomeVideos(Request $request)
    {
        // Create a new feature record in the database
        HomeVideos::create([
            'embed' => $request->input('embed'),
            'caption' => $request->input('caption'),
            'publish' => '1',
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.dashboard')->with('success', 'Video added successfully');
    }


    public function storePartner(Request $request)
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
        partners::create([
            'path' => $image_url,
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.partner')->with('success', 'Partner added successfully');
    }


    public function storeProgram(Request $request)
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
        programs::create([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.dashboard')->with('success', 'Program added successfully');
    }



    public function updateGallery(Request $request, $id)
    {
       
    
        // Find the HomeIssue record by ID
        $homeGallerys = HomeGallerys::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $homeGallerys->path; // Use the existing image URL by default
    
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
    
        // Update other fields in the record
        $homeGallerys->update([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            'embed' => $request->input('embed'),
            'button' => $request->input('button'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Gallery updated successfully');
    }


    public function updateHomeServices(Request $request, $id)
    {
    
        // Find the HomeIssue record by ID
        $homeServices = HomeServices::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $homeServices->path; // Use the existing image URL by default
    
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
    
        // Update other fields in the record
        $homeServices->update([
            'path' => $image_url,
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Service updated successfully');
    }

    public function updateHomeVideos(Request $request, $id)
    {
    
        // Find the HomeIssue record by ID
        $HomeVideos = HomeVideos::findOrFail($id);

        $publishStatus = $request->has('publish') ? 1 : 0;
    
        // Update other fields in the record
        $HomeVideos->update([
            'embed' => $request->input('embed'),
            'caption' => $request->input('caption'),
            'publish' => $publishStatus,
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Video updated successfully');
    }

    public function updateProgram(Request $request, $id)
    {
        // Find the HomeIssue record by ID
        $programs = programs::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $programs->path; // Use the existing image URL by default
    
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
    
        // Update other fields in the record
        $programs->update([
            'path' => $image_url,
            'header' => $request->input('header'),
            'caption' => $request->input('caption'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Program updated successfully');
    }


    public function updateExploreProgram(Request $request, $id)
    {
        // Find the HomeIssue record by ID
        $ExplorePrograms = ExplorePrograms::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $ExplorePrograms->path; // Use the existing image URL by default
    
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
    
        // Update other fields in the record
        $ExplorePrograms->update([
            'path' => $image_url,
            'header' => $request->input('header'),
            'button' => $request->input('button'),
            'link' => $request->input('link'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Explore Program updated successfully');
    }


    public function updatePartner(Request $request, $id)
    {    
        // Find the HomeIssue record by ID
        $partners = partners::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $partners->path; // Use the existing image URL by default
    
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
    
        // Update other fields in the record
        $partners->update([
            'path' => $image_url,
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.partner')->with('success', 'Partner updated successfully');
    }



    public function updateAbout(Request $request, $id)
    {
       
        // Find the HomeIssue record by ID
        $homeAbouts = HomeAbouts::findOrFail($id);
    
        // Update other fields in the record
        $homeAbouts->update([
            'details' => $request->input('details'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.dashboard')->with('success', 'Home About updated successfully');
    }




    public function destroyGallery($id)
    {
        $HomeGallerys = HomeGallerys::find($id);

        $HomeGallerys->delete('delete from HomeGallerys where id = ?',[$id]);
        
        $response = [
            "success" => 'Your gallery Image has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }

    public function destroyHomeServices($id)
    {
        $homeServices = HomeServices::find($id);

        $homeServices->delete('delete from homeServices where id = ?',[$id]);
        
        $response = [
            "success" => 'Your Service has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }


    public function destroyHomeVideos($id)
    {
        $HomeVideos = HomeVideos::find($id);

        $HomeVideos->delete('delete from HomeVideos where id = ?',[$id]);
        
        $response = [
            "success" => 'Your Video has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }


    public function destroyPartner($id)
    {
        $partners = partners::find($id);

        $partners->delete('delete from partners where id = ?',[$id]);
        
        $response = [
            "success" => 'Your partners  has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }

    public function destroyProgram($id)
    {
        $programs = programs::find($id);

        $programs->delete('delete from programs where id = ?',[$id]);
        
        $response = [
            "success" => 'Your program has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }

}
