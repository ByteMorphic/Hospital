<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Generic</title>
</head>

<body class="h-full">
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4">Edit Generic</h1>
        <hr>
        <br />
        <a href="/generics/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('generics.update', $generic->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="generic_name" class="block text-sm font-medium leading-6 text-gray-900">Generic Name</label>
                <div class="mt-2">
                    <input id="generic_name" name="generic_name" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('generic_name', $generic->generic_name) }}">
                    @error('generic_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <input id="generic_description" name="generic_description" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('generic_description', $generic->generic_description) }}">
                    @error('generic_description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="therapeutic_class" class="block text-sm font-medium leading-6 text-gray-900">Therapeutic Class</label>
                <div class="mt-2">
                    <input id="therapeutic_class" name="therapeutic_class" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('therapeutic_class', $generic->therapeutic_class) }}">
                    @error('therapeutic_class') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_category" class="block text-sm font-medium leading-6 text-gray-900">Catagory</label>
                <div class="mt-2">
                    <input id="generic_category" name="generic_category" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('generic_category', $generic->generic_category) }}">
                    @error('generic_category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_subcategory" class="block text-sm font-medium leading-6 text-gray-900">Sub-Catagory</label>
                <div class="mt-2">
                    <input id="generic_subcategory" name="generic_subcategory" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('generic_subcategory', $generic->generic_subcategory) }}">
                    @error('generic_subcategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_notes" class="block text-sm font-medium leading-6 text-gray-900">Notes</label>
                <div class="mt-2">
                    <input id="generic_notes" name="generic_notes" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('generic_notes', $generic->generic_notes) }}">
                    @error('generic_notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="generic_status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                </div>
                <div class="mt-2">
                    <input id="generic_status" name="generic_status" type="checkbox" class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" {{ old('generic_status', $generic->generic_status) ? 'checked' : '' }}>
                    @error('generic_status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
