<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specification;

class SpecificationController extends Controller
{
    public function index()
    {
        $specifications = Specification::orderBy('type')->orderBy('name')->paginate(10);
        return view('admin.specifications.index', compact('specifications'));
    }

    public function create()
    {
        return view('admin.specifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:performance,camera,battery,design,connectivity',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ], [
            'name.required' => 'Nama spesifikasi wajib diisi',
            'type.required' => 'Tipe spesifikasi wajib dipilih',
            'type.in' => 'Tipe spesifikasi tidak valid',
            'weight.required' => 'Bobot wajib diisi',
            'weight.min' => 'Bobot minimum 0',
            'weight.max' => 'Bobot maksimum 1'
        ]);

        Specification::create([
            'name' => $request->name,
            'type' => $request->type,
            'weight' => $request->weight,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.specifications.index')
                        ->with('success', 'Spesifikasi berhasil ditambahkan!');
    }

    public function show(Specification $specification)
    {
        return view('admin.specifications.show', compact('specification'));
    }

    public function edit(Specification $specification)
    {
        return view('admin.specifications.edit', compact('specification'));
    }

    public function update(Request $request, Specification $specification)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:performance,camera,battery,design,connectivity',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $specification->update([
            'name' => $request->name,
            'type' => $request->type,
            'weight' => $request->weight,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.specifications.index')
                        ->with('success', 'Spesifikasi berhasil diperbarui!');
    }

    public function destroy(Specification $specification)
    {
        $specification->delete();
        return redirect()->route('admin.specifications.index')
                        ->with('success', 'Spesifikasi berhasil dihapus!');
    }
}
