<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Medicine Info - {{ $medicine->name }}</title>
</head>

<body>
    <div class="container">
        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">
                <h1 class="text-2xl font-bold text-center mb-4">{{ $medicine->name }} Info</h1>
                <br />
                <a href = "{{ route('medicines.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Back </a>
                <br />
                <br />


                <table class="table-auto border-collapse border border-blue-500 container mx-auto">
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Medicine Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Description</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->description }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Generic Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->generic->generic_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Quantity</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->quantity }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Dosage</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->dosage }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Price</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->price }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Strength</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->strength }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Expiry Date</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100"> {{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d/m/Y') }} </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Notes</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->notes }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Manufacturer</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->manufacturer }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Category</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->category }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Route</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->route }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Status</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->status }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Image</td>
                        @if ($medicine->image == null)
                            <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100"><img src="{{ asset('images/no-image.jpeg') }}" alt="No Image" width="100" height="100"></td>
                        @else
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100 rounded-full"><img src="{{ asset($medicine->image) }}" alt="Image" width="100" height="100" class="rounded-full"></td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
</body>

</html>
