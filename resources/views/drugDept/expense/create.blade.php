@extends('layouts.app')
@section('title', 'Create Expense')
@section('content')
    <div class="container">
        <div class="p-4 pt-10 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center text-gray-800 dark:text-white">Enter Expense Details</h1>
            <a href="{{ URL::previous() }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800">Back</a>
            <br />
            <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <form method="POST" action="{{ route('expense.store') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="date" class="mb-3 block text-base font-medium text-[#07074D] dark:text-gray-300">
                             Date
                        </label>
                        <input type="date" name="date" id="date" autofocus
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                            value="{{ old('date') }}" />
                        @error('date')
                            <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_id" class="mb-3 block text-base font-medium text-[#07074D] dark:text-gray-300">
                            Ward
                        </label>
                        <select name="ward_id" id="ward_id"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                            <option value="" disabled>Select Ward</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}" {{ $ward->id == old('ward_id') ? 'selected' : '' }}>
                                    {{ $ward->ward_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ward_id')
                            <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="note" class="mb-3 block text-base font-medium text-[#07074D] dark:text-gray-300">
                            Note
                        </label>
                        <textarea name="note" id="note" placeholder="Any Note"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none hover:bg-[#5b54e0] dark:bg-[#5b54e0] dark:hover:bg-[#4a44cf]">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script>
        document.getElementById('date').valueAsDate = new Date();
    </script> --}}
    @push('scripts')
    <script>
        document.getElementById('date').valueAsDate = new Date();
        window.addEventListener("load", function() {
        setTimeout(() => {
            document.getElementById('date').focus();
        }, 50);  // Delay for 100ms
    });
    </script>
    @endpush
@endsection