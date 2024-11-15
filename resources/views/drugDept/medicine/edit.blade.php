@extends('layouts.app')
@section('title', 'Edit Medicine')
@section('content')
    <div class="container p-4 mx-2">
        <h1 class="text-2xl font-bold text-center mb-4 text-gray-900 dark:text-white">Edit Medicine</h1>
        <hr class="border-gray-300 dark:border-gray-600">
        <br />
        <a href="/medicines/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <form class="space-y-6" action="{{ route('medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Medicine Name</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->name }}">
                    @error('name') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="description" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Description</label>
                <div class="mt-2">
                    <input id="description" name="description" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->description }}" placeholder="Any Description (optional)">
                    @error('description') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="generic_id" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Generic Name</label>
                <div class="mt-2">
                    <select id="generic_id" name="generic_id" class="input">
                        @foreach($generics as $generic)
                            <option value="{{ $generic->id }}" {{ old('generic_id', $medicine->generic_id) == $generic->id ? 'selected' : '' }}>
                                {{ $generic->generic_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('generic_id') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="quantity" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Quantity</label>
                <div class="mt-2">
                    <input id="quantity" name="quantity" type="number" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->quantity }}" readonly>
                    <span class="text-green-600 dark:text-green-300 text-sm">You can't change the quantity</span>
                    @error('quantity') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="price" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Price</label>
                <div class="mt-2">
                    <input id="price" name="price" type="number" placeholder="Leave Empty, if its free" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->price }}">
                    @error('price') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="batch_no" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Batch No.</label>
                <div class="mt-2">
                    <input id="batch_no" name="batch_no" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->batch_no }}">
                    @error('batch_no') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
{{-- 
            <div>
                <label for="dosage" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Dosage</label>
                <div class="mt-2">
                    <input id="dosage" name="dosage" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->dosage }}">
                    @error('dosage') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div> --}}

            <div>
                <label for="strength" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Strength</label>
                <div class="mt-2">
                    <input id="strength" name="strength" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->strength }}">
                    @error('strength') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Route Select -->
            <div>
                <label for="route" class="label">Route</label>
                <div class="mt-2">
                    <select id="route" name="route" class="input" required>
                        <option value="" disabled selected>Select Route</option>
                        @foreach (['Oral', 'Intravenous', 'Intramuscular', 'Subcutaneous', 'Rectal', 'Vaginal', 'Inhalation', 'Nebulized', 'Opthalmic', 'Other'] as $route)
                            <option value="{{ $route }}" {{ old('route', $medicine->route) == $route ? 'selected' : '' }}>
                                {{ $route }}
                            </option>
                        @endforeach
                    </select>
                    @error('route')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Custom Route Input (Hidden by Default) -->
                    <div id="customRouteContainer" class="mt-4 hidden">
                        <label for="custom_route" class="label">Custom Route</label>
                        <input id="custom_route" name="custom_route" type="text" class="input" placeholder="Enter custom route" value="{{ old('custom_route', $medicine->custom_route) }}">
                        @error('custom_route')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <label for="notes" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Any Note</label>
                <div class="mt-2">
                    <input id="notes" name="notes" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->notes }}">
                    @error('notes') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="expiry_date" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Expiry Date</label>
                <div class="mt-2">
                    <input id="expiry_date" name="expiry_date" type="date" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ old('expiry_date', \Carbon\Carbon::parse($medicine->expiry_date)->format('Y-m-d')) }}">
                    @error('expiry_date') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="category" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Category</label>
                <div class="mt-2">
                    <input id="category" name="category" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->category }}">
                    @error('category') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="manufacturer" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Manufacturer</label>
                <div class="mt-2">
                    <input id="manufacturer" name="manufacturer" type="text" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300" value="{{ $medicine->manufacturer }}">
                    @error('manufacturer') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label for="status" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Status</label>
                <input id="status" name="status" type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="1" {{ old('status', $medicine->status ?? false) ? 'checked' : '' }}>
                @error('status') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">Upload Image</label>
                <div class="mt-2">
                    <input type="file" name="image" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300">
                    @error('image') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 dark:text-gray-400">Image should be less than 2MB</p>
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script>
            // Handle custom route logic
            const routeSelect = document.getElementById('route');
        const customRouteContainer = document.getElementById('customRouteContainer');
        const customRouteInput = document.getElementById('custom_route');

        routeSelect.addEventListener('change', function () {
            if (this.value === 'Other') {
                customRouteContainer.classList.remove('hidden');
                customRouteInput.setAttribute('required', 'required');
            } else {
                customRouteContainer.classList.add('hidden');
                customRouteInput.removeAttribute('required');
                customRouteInput.value = ''; // Clear the custom input field
            }
        });
</script>    
@endpush