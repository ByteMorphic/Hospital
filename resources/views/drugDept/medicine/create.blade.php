@extends('layouts.app')
@section('title', 'Create Medicine')
@section('content')

    <div class="container p-4 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4 dark:text-white">Create Medicine</h1>
        <hr>
        <br />
        <a href="/medicines/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <form class="space-y-6" action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Medicine Name Input -->
            <div>
                <label for="name" class="label">Medicine Name</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" class="input" required value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="label">Description</label>
                <div class="mt-2">
                    <input id="description" name="description" type="text" class="input" value="{{ old('description') }}">
                    @error('description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Generic Name Select -->
            <div>
                <label for="generic_id" class="label">Generic Name</label>
                <div class="mt-2">
                    <select id="generic_id" name="generic_id" class="input" required>
                        <option value="" disabled selected>Select Generic Name</option>
                        @foreach ($generics as $generic)
                            <option value="{{ $generic->id }}" {{ old('generic_id') == $generic->id ? 'selected' : '' }}>
                                {{ $generic->generic_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('generic_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Quantity Input -->
            <div>
                <label for="quantity" class="label">Quantity</label>
                <div class="mt-2">
                    <input id="quantity" name="quantity" type="number" class="input" value="{{ old('quantity') }}">
                    @error('quantity')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Strength Input -->
            <div>
                <label for="strength" class="label">Strength</label>
                <div class="mt-2">
                    <input id="strength" name="strength" type="text" class="input" value="{{ old('strength') }}">
                    @error('strength')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Price Input -->
            <div>
                <label for="price" class="label">Price</label>
                <div class="mt-2">
                    <input id="price" name="price" type="number" placeholder="Leave Empty, if it's free" class="input" value="{{ old('price') }}">
                    @error('price')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Batch No. Input -->
            <div>
                <label for="batch_no" class="label">Batch No.</label>
                <div class="mt-2">
                    <input id="batch_no" name="batch_no" type="text" class="input" value="{{ old('batch_no') }}">
                    @error('batch_no')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Route Select -->
            <div>
                <label for="route" class="label">Route</label>
                <div class="mt-2">
                    <select id="route" name="route" class="input" required>
                        <option value="" disabled selected>Select Route</option>
                        @foreach (['Oral', 'Intravenous', 'Intramuscular', 'Subcutaneous', 'Rectal', 'Vaginal', 'Inhalation', 'Nebulized', 'Opthalmic', 'Other'] as $route)
                            <option value="{{ $route }}" {{ old('route') == $route ? 'selected' : '' }}>
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
                        <input id="custom_route" name="custom_route" type="text" class="input" placeholder="Enter custom route">
                        @error('custom_route')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Notes Input -->
            <div>
                <label for="notes" class="label">Any Note</label>
                <div class="mt-2">
                    <input id="notes" name="notes" type="text" class="input" value="{{ old('notes') }}">
                    @error('notes')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Expiry Date Picker -->
            <div>
                <label for="expiry_date" class="label">Expiry Date</label>
                <div class="mt-2">
                    <input id="expiry_date" name="expiry_date" type="date" required class="input" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Category Input -->
            <div>
                <label for="category" class="label">Category</label>
                <div class="mt-2">
                    <input id="category" name="category" type="text" class="input" value="{{ old('category') }}">
                    @error('category')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Manufacturer Input -->
            <div>
                <label for="manufacturer" class="label">Manufacturer</label>
                <div class="mt-2">
                    <input id="manufacturer" name="manufacturer" type="text" class="input" value="{{ old('manufacturer') }}">
                    @error('manufacturer')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Status Checkbox -->
            <div>
                <label for="status" class="label">Status</label>
                <div class="mt-2">
                    <input id="status" name="status" type="checkbox" class="rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="1" {{ old('status', $medicine->status ?? 'false') == '1' ? 'checked' : '' }}>
                    @error('status')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="label">Upload Image</label>
                <div class="mt-2">
                    <input type="file" name="image" class="input">
                    @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                    <p class="text-xs text-gray-500">Image should be less than 2MB</p>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>

        </form>
    </div>

    <!-- Set default expiry date to today and handle custom route selection -->
    <script>
        // Set default expiry date to today's date
        document.getElementById('expiry_date').valueAsDate = new Date();

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

@endsection