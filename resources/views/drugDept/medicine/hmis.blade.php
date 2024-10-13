@extends('layouts.app')
@section('title', 'Medicines List')
@section('content')
    <div class="container p-24 mx-auto">
        <h1 class="mb-4 text-2xl font-bold text-center dark:text-white">Medicines & Surgical Items</h1>

        <!-- Add search form -->
        <form action="{{ route('medicines.totalAdd') }}" method="GET" class="mb-4">
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
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->total_quantity }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->status ? 'Active' : 'Inactive' }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                            <div class="inline-flex space-x-2">
                                <a href="javascript:void(0)" onclick="openModal({{ $medicine->id }})" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Add Stock</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

         <div class="flex items-center justify-center gap-3 my-4 text-sm">
             <x-drugdept.pagination :paginator="$medicines" />
         </div>
     </div>
 <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
     <div class="relative p-4 mx-auto my-20 bg-white w-1/3">
         <h2 class="text-xl font-bold">Add Stock</h2>
         <form action="{{ route('medicines.totalAddStore') }}" method="POST" class="mt-4">
             @csrf
             <input type="hidden" name="medicine_id" id="medicine_id">
             <div class="mb-4">
                 <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                 <input type="number" name="quantity" id="quantity" class="w-full px-4 py-2 border rounded">
             </div>
             <div class="flex justify-end">
                 <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Add Stock</button>
                 <button type="button" onclick="closeModal()" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Close</button>
             </div>
         </form>
     </div> 
    </div>
@endsection
@push('scripts')
    <script>
        function openModal(medicineId) {
            document.getElementById('medicine_id').value = medicineId;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
@endpush