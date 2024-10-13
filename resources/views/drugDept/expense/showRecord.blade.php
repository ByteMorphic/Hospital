@extends('layouts.app')

@section('title', 'Expense Records')

@section('content')
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Wards Info</h1>

        <a href="{{ route('expense.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" autofocus>Back</a>

        <table class="table-auto border-collapse border border-blue-500 container mx-auto mt-4">
            <tr>
                <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Date</td>
                <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">
                    {{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }} - {{ $expense->ward->ward_name }}
                </td>
            </tr>
            <tr>
                <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Medicines</td>
                <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">
                    @foreach($expenseRecords as $record)
                        <div class="flex items-center justify-between mb-2">
                            <span>{{ $record->medicine_name }} - {{ $record->generic_name }} ({{ $record->quantity }})</span>
                            <div>
                                <button 
                                    onclick="openEditModal({{ $record->id }}, '{{ $record->medicine_name }}', {{ $record->quantity }})" 
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</button>
                                <form action="{{ route('expenseRecord.destroy', $record->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Quantity</h3>
                <form id="editForm" action="" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="recordId" name="record_id">
                    <div class="mt-2">
                        <p id="medicineName" class="text-sm text-gray-500"></p>
                    </div>
                    <div class="mt-2">
                        <input type="number" id="quantity" name="quantity" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" required>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="saveButton" type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Save
                        </button>
                        <button type="button" onclick="closeEditModal()" class="mt-2 w-full px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-md">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openEditModal(id, name, quantity) {
            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            document.getElementById('recordId').value = id;
            document.getElementById('medicineName').textContent = name;
            document.getElementById('quantity').value = quantity;
            document.getElementById('editForm').action = `/expenseRecord/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>
@endpush