<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Medicine Record</title>
    </head>

<body class="h-full">
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4">Create Medicines</h1>
        <hr>
        <br />
        <a href="/medicines/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative container mx-auto mt-4 m-6" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Medicine Name</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('name') }}">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <input id="description" name="description" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('description') }}">
                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_id" class="block text-sm font-medium leading-6 text-gray-900">Generic Name</label>
                <div class="mt-2">
                    <select id="generic_id" name="generic_id" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Select Generic Name" required value="{{ old('generic_id') }}">
                        <option value="" disabled selected>Select Generic Name</option>
                        @foreach($generics as $generic)
                        <option value="{{ $generic->id }}">{{ $generic->generic_name }}</option>
                        @endforeach
                    </select>
                    @error('generic_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                <div class="mt-2">
                    <input id="quantity" name="quantity" type="number" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('quantity') }}">
                    @error('quantity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="strength" class="block text-sm font-medium leading-6 text-gray-900">Strength</label>
                <div class="mt-2">
                    <input id="strength" name="strength" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('strength') }}">
                    @error('strength') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                <div class="mt-2">
                    <input id="price" name="price" type="number" placeholder="Leave Empty, if its free" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('price') }}">
                    @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="batch_no" class="block text-sm font-medium leading-6 text-gray-900">Batch No.</label>
                <div class="mt-2">
                    <input id="batch_no" name="batch_no" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('batch_no') }}">
                    @error('batch_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="route" class="block text-sm font-medium leading-6 text-gray-900">Route</label>
                <div class="mt-2">
                <select id="route" name="route" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('route') }}" required>
                <option value="" disabled selected>Select Route</option>
                <option value="Oral">Oral</option>
                <option value="Intravenous">Intravenous</option>
                <option value="Intramuscular">Intramuscular</option>
                <option value="Subcutaneous">Subcutaneous</option>
                <option value="Topical">Intrathecal</option>
                <option value="Buccal">Buccal</option>
                <option value="Intrathecal">Intrathecal</option>
                <option value="Rectal">Rectal</option>
                <option value="Vaginal">Vaginal</option>
                <option value="Ocular">Ocular</option>
                <option value="Otic">Otic</option>
                <option value="Nasal">Nasal</option>
                <option value="Inhalation">Inhalation</option>
                <option value="Nebulized">Nebulized</option>
                <option value="Transdermal">Transdermal</option>
                <option value="Opthalmic">Opthalmic</option>
                <option value="Other">Other</option>
                </select>
                    @error('route') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Any Note</label>
                <div class="mt-2">
                    <input id="notes" name="notes" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('notes') }}">
                    @error('notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="expiry_date" class="block text-sm font-medium leading-6 text-gray-900">Expiry Date</label>
                <div class="mt-2">
                    <input id="expiry_date" name="expiry_date" type="date" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('expiry_date') }}">
                    @error('expiry_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                <div class="mt-2">
                    <input id="category" name="category" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('category') }}">
                    @error('category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="manufacturer" class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                <div class="mt-2">
                    <input id="manufacturer" name="manufacturer" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('manufacturer') }}">
                    @error('manufacturer') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                </div>
                <div class="mt-2">
                    <input id="status" name="status" type="checkbox" class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="1" {{ old('status', $medicine->status ?? 'false') == '1' ? 'checked' : '' }}>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <br />

                <div>
                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Upload Image</label>
                    </div>
                <div class="mt-2">
                    <input type="file" name="image" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500">Image should be less than 2MB</p>
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>

<!-- defult value today, and if also editable via click. also some other useful function -->
    <script>
        document.getElementById('expiry_date').valueAsDate = new Date();
    </script>
</body>

</html>
