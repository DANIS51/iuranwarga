<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DuesCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function addCategory()
    {
        return view('categories.add');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);

        DuesCategory::create([
            'name' => $request->name,
            'period' => $request->period,
            'nominal' => $request->nominal,
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }
}
