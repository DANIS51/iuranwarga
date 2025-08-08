<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\Officer;
use App\Models\User;
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
        $officers = Officer::with('user')->get();
        return view('categories.add', compact('officers'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'petugas' => 'required|exists:officers,id'
        ]);

        DuesCategory::create([
            'name' => $request->name,
            'payment_type' => $request->payment_type,
            'period' => $request->period,
            'nominal' => $request->nominal,
            'status' => $request->status,
            'petugas' => $request->petugas
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy($id)
    {
        try {
            $category = DuesCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
