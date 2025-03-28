@extends('layouts.app')
@section('title', '{{ $ward->ward_name }}')
@section('content')
    <div class="container">
        <div class="container p-4 mx-auto">
            <table class="table-auto w-full">
                <tr>
                    <td class="border px-4 py-2">Ward Name</td>
                    <td class="border px-4 py-2">{{ $ward->ward_name }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Ward Description</td>
                    <td class="border px-4 py-2">{{ $ward->ward_description }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Ward Capacity</td>
                    <td class="border px-4 py-2">{{ $ward->ward_capacity }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Status</td>
                    <td class="border px-4 py-2">{{ $ward->ward_status ? 'Active' : 'Inactive' }}</td>
                </tr>
            </table>
            <br />
            <a href="{{ route('wards.edit', $ward->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm">Edit</a>
            <a href="{{ URL::previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm">Back</a>
        </div>
    </div>
@endsection