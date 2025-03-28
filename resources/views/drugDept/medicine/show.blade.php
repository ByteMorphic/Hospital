@extends('layouts.app')
@section('title', 'Medicine Info')
@section('content')
            <div class="container p-24 mx-auto dark:bg-gray-800 dark:text-white">
                <h1 class="text-2xl font-bold text-center mb-4 dark:text-white">{{ $medicine->name }} Info</h1>
                <br />
                <a href = "{{ route('medicines.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm" > Back </a>
                <br />
                <br />


                <table class="table-auto border-collapse border border-blue-500 container mx-auto dark:bg-gray-800 dark:text-white">
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Medicine Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->name }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Description</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->description }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Generic Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->generic->generic_name }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Quantity</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->quantity }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Dosage</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->dosage }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Price</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->price }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Strength</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->strength }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Expiry Date</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white"> {{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d/m/Y') }} </td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Notes</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->notes }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Manufacturer</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->manufacturer }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Category</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->category }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Route</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->route }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Status</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $medicine->status }}</td>
                    </tr>
                    <tr class="dark:bg-gray-900 dark:text-white">
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white">Image</td>
                        @if ($medicine->image == null)
                            <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:text-white"><img src="{{ asset('images/no-image.jpeg') }}" alt="No Image" width="100" height="100"></td>
                        @else
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white"><img src="{{ asset($medicine->image) }}" alt="Image" width="100" height="100" class="rounded-full"></td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>

@endsection
