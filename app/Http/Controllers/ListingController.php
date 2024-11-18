<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ListingController extends Controller
{
    // public function index()
    // {
    //     $listings = Listing::all(); // Fetch all listings for users
    //     // dd($listings); // Debugging
    //     return view('listings.index', compact('listings'));
    // }
    
    public function index(Request $request)
    {
        $query = Listing::query()
            ->where('is_active', true)
            ->latest();
    
        if ($request->has('s')) {
            $searchQuery = trim($request->get('s'));
    
            $query->where(function (Builder $builder) use ($searchQuery) {
                $builder
                    ->orWhere('title', 'like', "%{$searchQuery}%")
                    ->orWhere('company', 'like', "%{$searchQuery}%")
                    ->orWhere('location', 'like', "%{$searchQuery}%");
            });
        }
    
        $listings = $query->get();
    
        return view('listings.index', compact('listings'));
    }
    

    

    public function apply(Listing $listing, Request $request)
    {
        $listing->clicks()
            ->create([
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip()
            ]);

        return redirect()->to($listing->apply_link);
    }
 
  

    public function edit($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();
        return view('listings.edit', compact('listing'));
    }
    
    
    public function update(Request $request, $id)
    {
        try {
            // Find the listing by its slug
            $listing = Listing::where('id', $id)->firstOrFail();
    
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required',
                'company' => 'required',
                'location' => 'required',
                'apply_link' => 'required|url',
                'content' => 'required',
            ]);
    
            // Update the listing attributes with the validated data
            $listing->fill($validatedData);
    
            // Check if a new logo file is uploaded
            if ($request->hasFile('logo')) {
                $listing->logo = basename($request->file('logo')->store('public'));
            }
    
            // Save the changes
            $listing->save();
            return view('listings.show', compact('listing'));

            // return redirect()->to(route('listings.show', $listing->id))->with('success', 'Listing updated successfully');
    
            // Redirect to the show page

            // return redirect()->route('listings.show', $listing->id)->with('success', 'Listing updated successfully');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->back()->with('error', 'Failed to update listing');
        }
    }
    
public function show($slug)
{
    try {
        $listing = Listing::where('slug', $slug)->firstOrFail();
        return view('listings.show', compact('listing'));
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'Listing not found');
    }
}
public function Ashow($id)
{
    try {
        $listing = Listing::where('id', $id)->firstOrFail();
        return view('listings.Ashow', compact('listing'));
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'Listing not found');
    }
}

public function destroy($id)
{
    try {
        // Find the listing by its ID
        $listing = Listing::findOrFail($id);
        
        // Delete the listing
        $listing->delete();
        
        // Redirect to the index page with success message
        return redirect()->route('listings.index')->with('success', 'Listing deleted successfully');
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'Failed to delete listing');
    }
}


public function delete($id)
{
    try {
        // Find the listing by its ID
        $listing = Listing::findOrFail($id);
        
        // Delete the listing
        $listing->delete();
        
        // Redirect to the index page with success message
        return redirect()->route('Admindashboard')->with('success', 'Listing deleted successfully');
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'Failed to delete listing');
    }
}



    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the form data
            $validationArray = [
                'title' => 'required',
                'company' => 'required',
                'logo' => 'file|max:2048',
                'location' => 'required',
                'apply_link' => 'required|url',
                'content' => 'required',
            ];

            if (!Auth::check()) {
                $validationArray = array_merge($validationArray, [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed|min:5',
                    'name' => 'required'
                ]);
            }

            $request->validate($validationArray);

            // Create a new listing
            $user = Auth::user();

            // If the user is not logged in, create a new user
            if (!$user) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                Auth::login($user);
            }

            // Process the listing creation without payment
            $md = new \ParsedownExtra();
            $listing = $user->listings()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . rand(1111, 9999),
                'company' => $request->company,
                'logo' => basename($request->file('logo')->store('public')),
                'location' => $request->location,
                'apply_link' => $request->apply_link,
                'content' => $md->text($request->input('content')),
                'is_active' => true
            ]);

            // Attach tags to the listing if provided
            if ($request->filled('tags')) {
                foreach (explode(',', $request->tags) as $requestTag) {
                    $tag = Tag::firstOrCreate([
                        'slug' => Str::slug(trim($requestTag))
                    ], [
                        'name' => ucwords(trim($requestTag))
                    ]);
                    $tag->listings()->attach($listing->id);
                }
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}