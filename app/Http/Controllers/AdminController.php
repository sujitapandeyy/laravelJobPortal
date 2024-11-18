<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class AdminController extends Controller
{
    // Method to show the dashboard for admin
    public function dashboard()
    {
        // You can fetch any data you want to display on the dashboard
        // For example, you might want to show a list of all listings
        $listings = Listing::all();

        // Then pass the data to the view and return it
        return view('admin.dashboard', compact('listings'));
    }
    public function index()
    {
        $listings = Listing::where('is_active', true)
                            ->with('tags')
                            ->latest()
                            ->get();
    
        return view('Admindashboard', compact('listings'));
    }
    
    // Method to show a form for creating a new listing
    public function createListingForm()
    {
        // You can customize this method to display a form for creating a new listing
        return view('admin.create_listing_form');
    }

    // Method to store a newly created listing
    public function storeListing(Request $request)
    {
        // You can implement the logic to store the newly created listing here
    }

    // Method to edit an existing listing
    public function editListingForm($id)
    {
        // You can customize this method to display a form for editing an existing listing
        $listing = Listing::findOrFail($id);
        return view('admin.edit_listing_form', compact('listing'));
    }

    // Method to update an existing listing
    public function updateListing(Request $request, $id)
    {
        // You can implement the logic to update the existing listing here
    }

    // Method to delete an existing listing
    public function deleteListing($id)
    {
        // You can implement the logic to delete the existing listing here
    }
}
?>