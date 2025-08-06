<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 500 karakter'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function show(Category $category)
    {
        $category->load('smartphones');
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 500 karakter'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // Check if category has smartphones
        if ($category->smartphones()->count() > 0) {
            return redirect()->route('admin.categories.index')
                            ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh smartphone!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}
