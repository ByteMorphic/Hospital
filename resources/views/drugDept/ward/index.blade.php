@extends('layouts.app')
@section('title', 'Wards List')
@section('content')
    <div class="container">

        <div class="container p-24 mx-auto">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-white ">Wards</h1>
            <a href="{{ route('wards.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm">Create New Ward</a>
            <br />
            <br />
            <br />
            <div class="rounded-lg border border-gray-200">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sr No.</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ward Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ward Description</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Capacity</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 border-t">
                            @foreach ($wards as $ward)
                                <tr class="border">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        {{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ward->ward_name }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ward->ward_description }}
                                    </td>
                                    @if ($ward->ward_capacity == 0)
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">Not Set</td>
                                    @else
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ward->ward_capacity }}
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        {{ $ward->ward_status ? 'Active' : 'Inactive' }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <span
                                            class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-xs pr-2 pl-2 ml-2 mr-2">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('wards.edit', $ward->id) }}"
                                                    class="text-blue-500 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('wards.show', $ward->id) }}"
                                                    class="text-yellow-500 hover:underline font-bold">Show</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                                <form action="{{ route('wards.destroy', $ward->id) }}" method="POST"
                                                    class="inline text-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:underline">Delete</button>
                                                </form>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="flex items-center justify-center gap-3 my-4 text-sm">
        <x-pagination :paginator="$wards" />
        </div>
        </div>
    </div>
@endsection