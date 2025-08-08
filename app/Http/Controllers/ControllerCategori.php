<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Officer;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerCategori extends Controller
{
    //
    public function edit(string $id)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }

        $category = DuesCategory::findOrFail($id);
        $officers = Officer::with('user')->get();

        return view('categories.categori-edit', compact('category', 'officers'));
    }

    public function update(Request $request, string $id)
{
    try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back()->with('danger', $e->getMessage());
    }

    $validation = $request->validate([
        'name' => 'required|max:50|min:1',
        'period' => 'required|string',
        'payment_type' => 'required|in:mingguan,bulanan,tahunan',
        'nominal' => 'required|numeric|min:0',
        'status' => 'required|in:active,inactive',
        'petugas' => 'required|exists:officers,id',
    ]);

    $category = DuesCategory::findOrFail($id);
    $category->update([
        'name' => $validation['name'],
        'period' => $validation['period'],
        'payment_type' => $validation['payment_type'],
        'nominal' => $validation['nominal'],
        'status' => $validation['status'],
        'petugas' => $validation['petugas'], // pastikan kolom ini memang ada di database
    ]);

    return redirect()->route('categories')->with('success', 'Data berhasil diubah');
}

}
