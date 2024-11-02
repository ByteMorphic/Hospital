@extends('layouts.app')
@section('title', 'Create New Ward Record')
@section('content')
    <div class="container">

        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center">Create New Ward Record</h1>
            <a href="{{ URL::previous() }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
            <br />
            <br />
            <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md">
                <form method="POST" action="{{ route('wards.store') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="ward_name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Name
                        </label>
                        <input type="text" name="ward_name" id="ward_name" placeholder="Ward Name"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ old('ward_name') }}" autofocus />
                        @error('ward_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_description" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Discription
                        </label>
                        <input type="text" name="ward_description" id="ward_description"
                            placeholder="Ward Description"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ old('ward_description') }}" />
                        @error('ward_description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_capacity" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Capacity
                        </label>
                        <input type="number" name="ward_capacity" id="ward_capacity" placeholder="Patient Capacity"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ old('ward_capacity') }}" />
                        @error('ward_capacity')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_status" class="mb-3 block text-base font-medium text-[#07074D]">
                            Status
                        </label>
                        <input type="checkbox" name="ward_status" id="ward_status"
                            class="rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            {{ old('ward_status') ? 'checked' : '' }} />
                    </div>

                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection