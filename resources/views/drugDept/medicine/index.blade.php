@extends('layouts.app')

@section('title', 'Medicines List')

@section('content')
    <div class="container p-6 mx-auto lg:p-24">
        <header class="mb-8">
            <h1 class="mb-6 text-2xl font-bold text-center text-gray-900 dark:text-white">Medicines & Surgical Items</h1>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('medicines.create') }}"
                    class="inline-flex items-center px-4 py-2 font-semibold text-white transition bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Medicine
                </a>
                <button onclick="openExcelExportModal()"
                    class="inline-flex items-center px-4 py-2 font-semibold text-white transition bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export to Excel
                </button>
            </div>
        </header>

        <!-- Search Form -->
        <form action="{{ route('medicines.index') }}" method="GET" class="mb-6">
            <div class="flex flex-col gap-4 sm:flex-row">
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Search by medicine or generic name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('search') }}">
                </div>
                <button type="submit"
                    class="px-6 py-2 font-semibold text-white transition bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Search
                </button>
            </div>
        </form>

        <!-- Medicines Table -->
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Sr
                                No.</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Medicine Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Generic Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Quantity</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($medicines as $medicine)
                            <tr class="transition hover:bg-gray-50" data-medicine-id="{{ $medicine->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $medicine->generic->generic_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap" id="quantity-{{ $medicine->id }}">
                                    {{ $medicine->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-sm {{ $medicine->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                                        {{ $medicine->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('medicines.edit', $medicine->id) }}"
                                            class="px-3 py-1 text-sm font-medium text-blue-600 transition rounded-md hover:bg-blue-50">
                                            Edit
                                        </a>
                                        <a href="{{ route('medicines.show', $medicine->id) }}"
                                            class="px-3 py-1 text-sm font-medium text-purple-600 transition rounded-md hover:bg-purple-50">
                                            Show
                                        </a>
                                        <button onclick="openModal({{ $medicine->id }})"
                                            class="px-3 py-1 text-sm font-medium text-gray-600 transition rounded-md hover:bg-gray-50">
                                            Add Stock
                                        </button>
                                        <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST"
                                            class="inline-block delete-form" data-medicine-name="{{ $medicine->name }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 text-sm font-medium text-red-600 transition rounded-md hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No medicines found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="py-4">
            {{ $medicines->links() }}
        </div>

        <!-- Add Stock Modal -->
        <div id="addStockModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" onclick="closeModal('addStockModal')"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form id="addStockForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="medicine_id" id="medicine_id">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Log Type</label>
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="log_type" value="approve" checked class="text-blue-600">
                                    <span class="ml-2">Approve</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="log_type" value="reject" class="text-blue-600">
                                    <span class="ml-2">Reject</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="log_type" value="pending" class="text-blue-600">
                                    <span class="ml-2">Pending</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="log_type" value="return" class="text-blue-600">
                                    <span class="ml-2">Return</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="2"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry
                                    Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Transaction
                                    Date</label>
                                <input type="date" name="date" id="date" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-5">
                            <button type="button" onclick="closeModal('addStockModal')"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Add Stock
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Export Modal -->
        <div id="exportModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" onclick="closeModal('exportModal')"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('medicines.export-to-excel') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Filter</label>
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="active" checked class="text-blue-600">
                                    <span class="ml-2">Active Only</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="inactive" class="text-blue-600">
                                    <span class="ml-2">Inactive Only</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="all" class="text-blue-600">
                                    <span class="ml-2">All Items</span>
                                </label>
                            </div>
                            <label class="">
                                <input type="radio" name="ExcludeZeroQuantityMedicine" value="yes" class="text-blue-600">
                                <span class="ml-2">Exclude Zero Quentity</span>
                            </label>
                        </div>

                        <div class="flex justify-end gap-3 mt-5">
                            <button type="button" onclick="closeModal('exportModal')"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Export to Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set today's date as default for transaction date
            document.getElementById('date').value = new Date().toISOString().slice(0, 10);

            // Initialize delete form handlers
            initializeDeleteForms();
        });

        // Modal handling functions
        function openModal(id) {
            document.getElementById('medicine_id').value = id;
            document.getElementById('addStockModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openExcelExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        // Form handling
        document.getElementById('addStockForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const medicineId = document.getElementById('medicine_id').value;
            const formData = new FormData(form);

            try {
                const response = await axios.post(`/medicines/${medicineId}/add-stock`, formData);

                if (response.data.success) {
                    // Update quantity in table
                    const quantityCell = document.getElementById(`quantity-${medicineId}`);
                    if (quantityCell) {
                        quantityCell.textContent = response.data.new_quantity;
                    }

                    // Show success message
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Close modal and reset form
                    closeModal('addStockModal');
                    form.reset();
                    document.getElementById('date').value = new Date().toISOString().slice(0, 10);
                }
            } catch (error) {
                console.error('Error:', error);

                let errorMessage = 'An error occurred while updating the stock.';
                if (error.response && error.response.data && error.response.data.message) {
                    errorMessage = error.response.data.message;
                }

                await Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage
                });
            }
        });

        // Delete confirmation handling
        function initializeDeleteForms() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const medicineName = this.dataset.medicineName;

                    const result = await Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${medicineName}. This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    });

                    if (result.isConfirmed) {
                        try {
                            await axios.delete(this.action);

                            await Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: `${medicineName} has been deleted successfully.`,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Remove the row from the table
                            this.closest('tr').remove();
                        } catch (error) {
                            console.error('Error:', error);

                            await Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete the medicine. Please try again.'
                            });
                        }
                    }
                });
            });
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(e) {
            const modals = ['addStockModal', 'exportModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (e.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        // Handle escape key to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modals = ['addStockModal', 'exportModal'];
                modals.forEach(closeModal);
            }
        });
    </script>
@endpush
