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


class AlistingController extends Controller
{
public function delete($id)
{
    try {
        // Find the listing by its ID
        $listing = Listing::findOrFail($id);
        // dd($listing);
        // Delete the listing
        $listing->delete();
        
        // Redirect to the index page with success message
        return redirect()->route('Admindashboard')->with('success', 'Listing deleted successfully');
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'Failed to delete listing');
    }
}

}