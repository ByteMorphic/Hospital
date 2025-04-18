<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ward\WardResource;
use App\Models\Ward;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        $query = Ward::query();

        if ($search) {
            $query->where('ward_name', 'LIKE', "%{$search}%");
        }

        $wards = $query->paginate(30);

        return Inertia::render('DrugDept/Ward/index', [
            'wards' => WardResource::collection($wards),
            'filters' => [
                'q' => $search,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ward_name' => 'required|string|max:255',
            'ward_description' => 'required|string',
            'ward_capacity' => 'numeric|nullable',
            'ward_status' => 'nullable',
        ]);

        Ward::create([
            'ward_name' => $request->ward_name,
            'ward_description' => $request->ward_description,
            'ward_capacity' => $request->ward_capacity,
            'ward_status' => $request->ward_status == true ? 1 : 0,
        ]);

        return redirect('/wards')->with('success', 'Ward created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ward $ward)
    {
        $request->validate([
            'ward_name' => 'required|string|max:255',
            'ward_description' => 'required|string',
            'ward_capacity' => 'numeric|nullable',
            'ward_status' => 'nullable',
        ]);

        $ward->update([
            'ward_name' => $request->ward_name,
            'ward_description' => $request->ward_description,
            'ward_capacity' => $request->ward_capacity,
            'ward_status' => $request->ward_status == true ? 1 : 0,
        ]);

        return redirect('/wards')->with('success', 'Ward updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        $ward->delete();
        return redirect('/wards')->with('info', 'Ward deleted successfully.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|lowercase|in:block,active',
            'ward_id' => 'required|exists:wards,id'
        ]);

        $ward = Ward::findOrFail($request->ward_id);
        $ward->ward_status = $request->status === 'active';
        $ward->save();

        return back();
    }
}
