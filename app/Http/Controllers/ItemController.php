<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('name', 'asc')->get();
		return view('admin.Item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$categories = Category::all();
        return view('admin.Item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required|string',
			'price' => 'required|numeric',
			'category_id' => 'required|exists:categories,id',
			'image' => 'sometimes|max:2048|image|mimes:jpg,jpeg,png,gif',
			'is_active' => 'required|boolean',
		], [
			'name.required' => 'Nama menu harus diisi.',
			'description.required' => 'Deskripsi harus diisi.',
			'description.string' => 'Deskripsi harus berupa teks.',
			'price.required' => 'Harga harus diisi.',
			'price.numeric' => 'Harga harus berupa angka.',
			'category_id.required' => 'Kategori harus dipilih.',
			'image.required' => 'Gambar harus diunggah.',
			'image.max' => 'Ukuran gambar maksimal 2MB.',
			'image.image' => 'File yang diunggah harus berupa gambar.',
			'is_active.boolean' => 'Status harus berupa boolean.',
		]);

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '.' . $image->getClientOriginalExtension();
			$image->move(public_path('img_item_upload'), $imageName);

			$validatedData['image'] = $imageName;
		}

		$item = Item::create($validatedData);
		return redirect()->route('items.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
		$categories = Category::all();
		return view('admin.Item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required|string',
			'price' => 'required|numeric',
			'category_id' => 'required|exists:categories,id',
			'image' => 'sometimes|max:2048|image|mimes:jpg,jpeg,png,gif',
			'is_active' => 'required|boolean',
		], [
			'name.required' => 'Nama menu harus diisi.',
			'description.required' => 'Deskripsi harus diisi.',
			'description.string' => 'Deskripsi harus berupa teks.',
			'price.required' => 'Harga harus diisi.',
			'price.numeric' => 'Harga harus berupa angka.',
			'category_id.required' => 'Kategori harus dipilih.',
			'image.required' => 'Gambar harus diunggah.',
			'image.max' => 'Ukuran gambar maksimal 2MB.',
			'image.image' => 'File yang diunggah harus berupa gambar.',
			'is_active.boolean' => 'Status harus berupa boolean.',
		]);

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '.' . $image->getClientOriginalExtension();
			$image->move(public_path('img_item_upload'), $imageName);

			$validatedData['image'] = $imageName;
		}

		$item = Item::findOrFail($id);
		$item->update($validatedData);
		return redirect()->route('items.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
		$item->delete();
		return redirect()->route('items.index')->with('success', 'Menu berhasil dihapus.');
    }
}
