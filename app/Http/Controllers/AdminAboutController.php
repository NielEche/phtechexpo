<?php

namespace App\Http\Controllers; 
use App\Models\AboutGallerys;
use App\Models\AboutUs;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Uploader;
use Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminAboutController extends Controller
{
    public function index()
    {

        $aboutGallerys = AboutGallerys::all();
        $aboutUs = AboutUs::all();
        return view('admin.about', ['aboutGallerys' => $aboutGallerys, 'aboutUs' => $aboutUs]);
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
        AboutGallerys::create([
            'path' => $image_url,
            'caption' => $request->input('caption'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.about')->with('success', 'Image added successfully');
    }


    public function storePara(Request $request)
    {
        // Create a new feature record in the database
        AboutUs::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            // Add more fields as needed
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.about')->with('success', 'Paragraph added successfully');
    }


    public function updateGallery(Request $request, $id)
    {
       
        // Find the HomeIssue record by ID
        $aboutGallerys = AboutGallerys::findOrFail($id);
    
        // Initialize the $image_url variable
        $image_url = $aboutGallerys->path; // Use the existing image URL by default
    
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
        $aboutGallerys->update([
            'path' => $image_url,
            'caption' => $request->input('caption'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.about')->with('success', 'Slider updated successfully');
    }


    public function updatePara(Request $request, $id)
    {
        // Find the HomeIssue record by ID
        $aboutUs = AboutUs::findOrFail($id);
    
        // Update other fields in the record
        $aboutUs->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            // Add other fields as needed
        ]);
    
        // Redirect or return a response as needed
        return redirect()->route('admin.about')->with('success', 'Paragraph updated successfully');
    }


    public function aboutEdit($id)
    {
        $about = AboutUs::find($id);
    
        if (!$about) {
            return redirect()->route('admin.about')->with('error', 'About Paragraph not found');
        }
    
        return view('admin.aboutEdit', compact('about'));
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


    public function destroyPara($id)
    {
        $aboutUs = AboutUs::find($id);

        $aboutUs->delete('delete from aboutUs where id = ?',[$id]);
        
        $response = [
            "success" => 'Your paragraph  has been Deleted Successfully'
        ];
        
        return redirect()->back()->with($response );
    }
}
