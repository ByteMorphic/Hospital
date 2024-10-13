@extends('layouts.app')

@section('title', 'Medicines List')

@section('content')
    <div class="container p-24 mx-auto">
        <h1 class="mb-4 text-2xl font-bold text-center dark:text-white">Medicines & Surgical Items</h1>
        <a href="{{ route('medicines.create') }}"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create New Medicine</a>
        <a href="{{ route('medicines.export-to-excel') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Export</a>
        <br /><br />

        <!-- Add search form -->
        <form action="{{ route('medicines.index') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Search by medicine or generic name"
                       class="w-full px-4 py-2 border rounded-l"
                       value="{{ request('search') }}">
                <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded-r hover:bg-blue-700">
                    Search
                </button>
            </div>
        </form>

        <div class="border border-gray-200 rounded-lg">
            <div class="overflow-x-auto rounded-t-lg">
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="text-left">
                        <tr>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Sr No.</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Medicine Name</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Generic Name</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Quantity</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Status</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Action</th>
                        </tr>
                    </thead>

                    <tbody class="border-t divide-y divide-gray-200">
                        @foreach($medicines as $medicine)
                            <tr class="border" data-medicine-id="{{ $medicine->id }}">
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->name }}</td>
                                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->generic->generic_name }}</td>
                                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->quantity }}</td>
                                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->status ? 'Active' : 'Inactive' }}</td>
                                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex space-x-2">
                                        <a href="{{ route('medicines.edit', $medicine->id) }}" class="px-4 py-2 text-sm font-medium text-blue-700 hover:bg-gray-50">Edit</a>
                                        <a href="{{ route('medicines.show', $medicine->id) }}" class="px-4 py-2 text-sm font-medium text-purple-700 hover:bg-gray-50">Show</a>
                                        <a href="javascript:void(0)" onclick="openModal({{ $medicine->id }})" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Add Stock</a>
                                        <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this medicine?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-red-700 hover:bg-gray-50">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-center gap-3 my-4 text-sm">
            <x-drugdept.pagination :paginator="$medicines" />
        </div>
    </div>
    @if ($medicines->count() === 0)
    <p class="text-center dark:text-white"></p>
@else
    <!-- Add Stock Modal -->
    <div id="addStockModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            <div class="z-50 w-11/12 p-6 bg-white rounded-lg shadow-lg">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-lg font-semibold">Add Stock</p>
                    <button id="close" class="text-lg font-semibold">&times;</button>
                </div>
                <form action="{{ route('medicines.addStock', $medicine->id) }}" method="POST" id="addStockForm">
                    @csrf
                    <input type="hidden" name="medicine_id" id="medicine_id" value="{{ $medicine->id }}">
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-gray-700">Log Type</p>
                        <input type="radio" name="log_type" value="approve" checked> Approve
                        <input type="radio" name="log_type" value="reject"> Reject
                        <input type="radio" name="log_type" value="panding"> Pending
                        <input type="radio" name="log_type" value="return"> Return
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Note</label>
                        <input type="text" name="notes" id="notes" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="w-full border mb-2 rounded py-2" required>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date of Transection</label>
                        <input type="date" name="date" id="date" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Add Stock</button>
                    <button type="button" id="cancel" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Cancel</button>
                </form>
                
            </div>
        </div>
    </div>
@endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function openModal(id) {
    document.getElementById('addStockModal').classList.remove('hidden');
    document.getElementById('medicine_id').value = id;
    document.getElementById('addStockForm').setAttribute('data-medicine-id', id);
}

document.getElementById('close').addEventListener('click', function () {
    document.getElementById('addStockModal').classList.add('hidden');
});

document.getElementById('cancel').addEventListener('click', function () {
    document.getElementById('addStockModal').classList.add('hidden');
});

document.getElementById('addStockForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const medicineId = form.getAttribute('data-medicine-id');
    const formData = new FormData(form);
    formData.append('date', new Date().toISOString().slice(0, 10)); // Add current date

    axios.post(`/medicines/${medicineId}/add-stock`, formData)
        .then(response => {
            if (response.data.success) {
                // Update the quantity in the table
                const quantityCell = document.querySelector(`tr[data-medicine-id="${medicineId}"] td:nth-child(4)`);
                if (quantityCell) {
                    quantityCell.textContent = response.data.new_quantity;
                }

                // Close the modal
                document.getElementById('addStockModal').classList.add('hidden');

                // Show success message
                alert(response.data.message);

                // Clear the form
                form.reset();
            } else {
                alert('An error occurred while updating the stock.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the stock.');
        });
});
// add today date to date id
document.getElementById('date').value = new Date().toISOString().slice(0, 10);

</script>
@endpush
