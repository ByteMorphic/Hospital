@extends('layouts.app')

@section('title', 'Medicine Logs')

@section('content')
<div class="container mx-auto p-6 dark:bg-gray-800 dark:text-white">
    <div class="header mb-6 text-center">
        <h1 class="text-3xl font-semibold">{{ $medicine->name }} - Logs</h1>
        <a href="{{ route('medicines.index') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
            Back
        </a>
    </div>

    <div class="table-wrapper overflow-x-auto bg-white shadow-md rounded-lg dark:bg-gray-700">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="p-3 text-center">Sr. No</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-center">Quantity</th>
                    <th class="p-3 text-center">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicineLogs as $log)
                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                    <td class="p-3 text-center">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ ucfirst($log->log_type) }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y') }}</td>
                    <td class="p-3 text-center">{{ $log->quantity }}</td>
                    <td class="p-3 text-center">{{ $log->notes }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
