<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class HomeController extends Controller
{
    public function stafDashboard(Request $request)
    {
        $user = Auth::user();
        
        // Ambil kategori yang ada di database
        $categories = Category::all();
        
        // Menyaring berdasarkan kategori jika ada
        $categoryFilter = $request->input('category');
        $search = $request->input('search'); // Ambil input pencarian

        $itemsQuery = Item::with('category');
        
        // Jika ada filter kategori, kita filter berdasarkan kategori
        if ($categoryFilter) {
            $itemsQuery->where('category_id', $categoryFilter);
        }

        // Jika ada filter pencarian berdasarkan nama, kita filter berdasarkan nama
        if ($search) {
            $itemsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Ambil data yang sudah difilter, gunakan pagination untuk mempermudah
        $items = $itemsQuery->paginate(10);

        return view('staf.dashboard', compact('items', 'categories'));
    }


    public function search(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian

        $items = Item::with('category') // Load relasi category
                    ->where('name', 'like', '%' . $search . '%') // Pencarian berdasarkan nama
                    ->orWhereHas('category', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%'); // Pencarian berdasarkan kategori
                    })
                    ->paginate(10);

        return view('staf.dashboard', compact('items'));
    }

}
