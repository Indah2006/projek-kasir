<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $pelanggans = Pelanggan::when($search, function ($query, $search) {
        return $query->where('NamaPelanggan', 'like', "%{$search}%");
    })->get();

    return view('pelanggan.index', compact('pelanggans', 'search'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
        ]);

        Pelanggan::create([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {   
    $pelanggan = Pelanggan::with('penjualans')->find($id);
    if (!$pelanggan) {
        return redirect()->route('pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
    }

    return view('pelanggan.edit', compact('pelanggan'));
    }


    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) {
            return redirect()->route('pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
        ]);

        $pelanggan->update([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) {
            return redirect()->route('pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
