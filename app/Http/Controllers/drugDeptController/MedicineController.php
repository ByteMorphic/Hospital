<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Generic;
use App\Models\Medicine;
use App\Models\Medicine_log;
use App\Services\ExcelExportService;


class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('generic', function ($q) use ($searchTerm) {
                        $q->where('generic_name', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $medicines = $query->orderBy('name')->paginate(25);

        return view('drugDept.medicine.index', [
            'medicines' => $medicines,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generics = Generic::all()->where('generic_status', 1);
        return view('drugDept.medicine.create', compact('generics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'generic_id' => 'required|integer',
            'quantity' => 'nullable|integer',
            'price' => 'nullable|integer',
            'batch_no' => 'nullable|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
            'expiry_date' => 'date|nullable',
            'category' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        $filename = null;
        if ($request->hasFile('med_image')) {
            $file = $request->file('med_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/medicines/';
            $file->move($path, $filename);
        }

        try {
            Medicine::create([
                'name' => $request->name,
                'description' => $request->description,
                'generic_id' => $request->generic_id,
                'quantity' => $request->quantity,
                'total_quantity' => $request->quantity,
                'price' => $request->price,
                'batch_no' => $request->batch_no,
                'dosage' => $request->dosage,
                'strength' => $request->strength,
                'route' => $request->route,
                'notes' => $request->notes,
                'expiry_date' => $request->expiry_date,
                'category' => $request->category,
                'manufacturer' => $request->manufacturer,
                'status' => $request->has('status') ? 1 : 0,
                'image' => $path . $filename,
            ]);

            return redirect('/medicines')->with('success', 'Medicine created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Get SQL error message
            $errorMessage = $e->getMessage();

            // Redirect back with error message
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        $medicine = Medicine::with('generic')->find($medicine->id);
        return view('drugDept.medicine.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        $generics = Generic::all()->where('generic_status', 1);
        return view('drugDept.medicine.edit', compact('medicine', 'generics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'generic_id' => 'required|integer',
            'quantity' => 'nullable|integer',
            'price' => 'nullable|integer',
            'batch_no' => 'nullable|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
            'expiry_date' => 'date|nullable',
            'category' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $medicine->image;
        $filename = null;
        if ($request->hasFile('image')) {
            if (File::exists(public_path($medicine->image))) {
                File::delete(public_path($medicine->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/medicines/';
            $file->move($path, $filename);
        }

        try {
            $medicine->update([
                'name' => $request->name,
                'description' => $request->description,
                'generic_id' => $request->generic_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'batch_no' => $request->batch_no,
                'dosage' => $request->dosage,
                'strength' => $request->strength,
                'route' => $request->route,
                'notes' => $request->notes,
                'expiry_date' => $request->expiry_date,
                'category' => $request->category,
                'manufacturer' => $request->manufacturer,
                'status' => $request->has('status') ? 1 : 0,
                'image' => $path . $filename,
            ]);

            return redirect('/medicines')->with('success', 'Medicine updated successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Get SQL error message
            $errorMessage = $e->getMessage();
            // Redirect back with error message
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        // Optionally, delete the image file from storage
        if (File::exists(public_path($medicine->image))) {
            File::delete(public_path($medicine->image));
        }
        $medicine->delete();
        return redirect('/medicines')->with('info', 'Medicine deleted successfully.');
    }

    public function total(Request $request)
    {
        $query = Medicine::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('generic', function ($q) use ($searchTerm) {
                        $q->where('generic_name', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $medicines = $query->orderBy('name')->paginate(25);

        return view('drugDept.medicine.total', [
            'medicines' => $medicines,
        ]);
    }
    /**
     * Add stock to the specified medicine.
     */
    public function AddStock(Request $request, Medicine $medicine)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'log_type' => 'required|string|max:255',
            'expiry_date' => 'nullable|date',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            'medicine_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            if ($request->log_type == 'approve') {
                $medicine->increment('quantity', $request->quantity);
                
                // Update expiry_date only if provided and different from the existing value
                if ($request->filled('expiry_date') && $request->expiry_date != $medicine->expiry_date) {
                    $medicine->expiry_date = $request->expiry_date;
                }
                $medicine->total_quantity += $request->quantity;
            } elseif ($request->log_type == 'return') {
                $medicine->decrement('quantity', $request->quantity);
                $medicine->total_quantity -= $request->quantity;
            }

            $medicine->save();

            $medicineLog = Medicine_log::create([
                'log_type' => $request->log_type,
                'medicine_id' => $request->medicine_id,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'notes' => $request->notes,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Stock updated successfully.',
                'new_quantity' => $medicine->quantity,
                'log' => $medicineLog
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function totalAdd(Request $request)
    {
        $query = Medicine::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('generic', function ($q) use ($searchTerm) {
                        $q->where('generic_name', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $medicines = $query->orderBy('name')->paginate(25);

        return view('drugDept.medicine.hmis', [
            'medicines' => $medicines,
        ]);
    }

    public function totalAddStore(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'medicine_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $medicine = Medicine::find($request->medicine_id);
            $medicine->total_quantity += $request->quantity;
            $medicine->save();

            DB::commit();

            return redirect('/medicines/hmis')->with('success', 'Stock updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    protected $excelExportService;

    public function __construct(ExcelExportService $excelExportService)
    {
        $this->excelExportService = $excelExportService;
    }

    public function exportToExcel(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            // validate only that have value = remove_zero_quantity
            'ExcludeZeroQuantityMedicine' => 'nullable|string|max:5'
        ]);

        // Fetch your data with the associated generic name
        $medicines = Medicine::with('generic:id,generic_name') // Optimize the relationship query
            ->select('id', 'name', 'category', 'route', 'generic_id', 'quantity', 'total_quantity', 'status')
            ->orderBy('name')
            ->where('status', $request->status == 'active' ? 1 : 0);

        // Apply zero quantity filter if requested
        if ($request->ExcludeZeroQuantityMedicine == 'yes') {
            $medicines = $medicines->where('quantity', '>', 0);
        }

        // Execute the query to get the result
        $medicines = $medicines->get();


        // Prepare the data
        $data = [];
        foreach ($medicines as $medicine) {
            $data[] = [
                'name' => $medicine->name,
                'category' => $medicine->category,
                'route' => $medicine->route,
                'generic_name' => $medicine->generic->generic_name ?? 'N/A', // Handle potential null
                'quantity' => $medicine->quantity,
                'total_quantity' => $medicine->total_quantity,
                'status' => $medicine->status == 1 ? 'Active' : 'Inactive',
                'used' => $medicine->getTotalUsedAttribute(), // Call the model function
            ];
        }

        // Define the headers for the Excel file
        $headers = ['Medicine Name', 'Category', 'Route', 'Generic Name', 'Quantity', 'Total Quantity', 'Status', 'Used'];

        // Call the export service
        $filePath = $this->excelExportService->export($data, $headers, 'medicines.xlsx');

        // file name
        $filename = "medicine_" . date('Ymd') . ".xlsx";

        // Return the file as a download response
        return Response::download($filePath, $filename)->deleteFileAfterSend(true);
    }

}
