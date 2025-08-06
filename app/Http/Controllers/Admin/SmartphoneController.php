<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smartphone;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class SmartphoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Smartphone::with('category');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('brand', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('model', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('full_name', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        // Filter by price range
        if ($request->has('price_range') && !empty($request->price_range)) {
            [$minPrice, $maxPrice] = explode('-', $request->price_range);
            $query->whereBetween('price_min', [$minPrice, $maxPrice]);
        }

        $smartphones = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::active()->get();

        return view('admin.smartphones.index', compact('smartphones', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.smartphones.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'ram' => 'required|integer|min:1',
            'storage' => 'required|integer|min:1',
            'battery' => 'required|integer|min:1000',
            'camera' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean'
        ], [
            'brand.required' => 'Brand wajib diisi',
            'model.required' => 'Model wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'price_min.required' => 'Harga minimum wajib diisi',
            'price_max.required' => 'Harga maximum wajib diisi',
            'price_max.gte' => 'Harga maximum harus lebih besar atau sama dengan harga minimum',
            'ram.required' => 'RAM wajib diisi',
            'storage.required' => 'Storage wajib diisi',
            'battery.required' => 'Baterai wajib diisi',
            'camera.required' => 'Kamera wajib diisi',
            'image_url.url' => 'URL gambar tidak valid'
        ]);

        // Generate full name
        $fullName = $request->brand . ' ' . $request->model;

        Smartphone::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'full_name' => $fullName,
            'category_id' => $request->category_id,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'ram' => $request->ram,
            'storage' => $request->storage,
            'battery' => $request->battery,
            'camera' => $request->camera,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.smartphones.index')
                        ->with('success', 'Smartphone berhasil ditambahkan!');
    }

    public function show(Smartphone $smartphone)
    {
        $smartphone->load(['category', 'specifications']);
        return view('admin.smartphones.show', compact('smartphone'));
    }

    public function edit(Smartphone $smartphone)
    {
        $categories = Category::active()->get();
        return view('admin.smartphones.edit', compact('smartphone', 'categories'));
    }

    public function update(Request $request, Smartphone $smartphone)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'ram' => 'required|integer|min:1',
            'storage' => 'required|integer|min:1',
            'battery' => 'required|integer|min:1000',
            'camera' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean'
        ], [
            'brand.required' => 'Brand wajib diisi',
            'model.required' => 'Model wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'price_min.required' => 'Harga minimum wajib diisi',
            'price_max.required' => 'Harga maximum wajib diisi',
            'price_max.gte' => 'Harga maximum harus lebih besar atau sama dengan harga minimum',
            'ram.required' => 'RAM wajib diisi',
            'storage.required' => 'Storage wajib diisi',
            'battery.required' => 'Baterai wajib diisi',
            'camera.required' => 'Kamera wajib diisi',
            'image_url.url' => 'URL gambar tidak valid'
        ]);

        // Generate full name
        $fullName = $request->brand . ' ' . $request->model;

        $smartphone->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'full_name' => $fullName,
            'category_id' => $request->category_id,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'ram' => $request->ram,
            'storage' => $request->storage,
            'battery' => $request->battery,
            'camera' => $request->camera,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.smartphones.index')
                        ->with('success', 'Smartphone berhasil diperbarui!');
    }

    public function destroy(Smartphone $smartphone)
    {
        $smartphone->delete();

        return redirect()->route('admin.smartphones.index')
                        ->with('success', 'Smartphone berhasil dihapus!');
    }
}
