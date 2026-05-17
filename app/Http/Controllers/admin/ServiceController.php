<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display services
     */
    public function index()
    {
        $services = Service::latest()->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store service
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = null;

        // Upload image
        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('services'), $imageName);
        }

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update service
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = $service->image;

        // Upload image baru
        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('services'), $imageName);
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect('/admin/services')
            ->with('success', 'Service updated successfully');
    }

        /**
     * Delete service
     */
    public function destroy(Service $service)
    {
        // Hapus gambar jika ada
        if ($service->image && file_exists(public_path('services/'.$service->image))) {

            unlink(public_path('services/'.$service->image));
        }

        // Hapus data
        $service->delete();

        return redirect('/admin/services')
            ->with('success', 'Service deleted successfully');
    }
}
