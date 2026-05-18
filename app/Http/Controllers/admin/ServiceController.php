<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display services
     */
    public function index()
    {
        $services = Service::latest()->get();

        return view(
            'admin.services.index',
            compact('services')
        );
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
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = null;

        // Upload image
        if ($request->hasFile('image')) {

            $imageName = $request->file('image')
                ->store('services', 'public');
        }

        Service::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName,
        ]);

        return redirect('/admin/services')
            ->with(
                'success',
                'Service created successfully'
            );
    }

    /**
     * Show edit form
     */
    public function edit(Service $service)
    {
        return view(
            'admin.services.edit',
            compact('service')
        );
    }

    /**
     * Update service
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,jpg',
        ]);

        // Default image lama
        $imageName = $service->image;

        // Jika upload image baru
        if ($request->hasFile('image')) {

            // Hapus image lama
            if (
                $service->image &&
                Storage::disk('public')->exists($service->image)
            ) {

                Storage::disk('public')
                    ->delete($service->image);
            }

            // Upload image baru
            $imageName = $request->file('image')
                ->store('services', 'public');
    }

        // Update database
        $service->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName,
        ]);

        return redirect('/admin/services')
            ->with(
                'success',
                'Service updated successfully'
            );
    }
}
