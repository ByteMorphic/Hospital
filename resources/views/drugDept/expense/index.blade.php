@extends('layouts.app')
@section('title', 'Expense Records')
@section('content')

<div class="container">
        <div class=" p-6">
            <h1 class="mb-4 text-2xl font-bold text-center text-gray-900 dark:text-white">Expense History</h1>
            <a href="{{ route('expense.create') }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800" id="autofocus">New Expense</a>
                <!--  download Button -->
                <a href="javascript:void(0)"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800"
                    onclick="downloadModel.classList.remove('hidden')">Download</a>
                    <!--  filter button start -->
                    <form action="{{ route('expense.index') }}" method="GET" class="w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center mt-5">
        <!-- Ward Filter -->
        <div class="lg:col-span-4">
            <div class="flex items-center gap-2">
                <label for="ward" class="text-gray-700 dark:text-gray-200 whitespace-nowrap w-20">Ward</label>
                <select name="ward_id[]" id="ward" class="select2-ward w-full" multiple>
                    @if(!empty($selectedWards))
                        @foreach($selectedWards as $ward)
                            <option value="{{ $ward->id }}" selected>{{ $ward->ward_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <!-- Medicine Filter -->
        <div class="lg:col-span-5">
            <div class="flex items-center gap-2">
                <label for="medicine" class="text-gray-700 dark:text-gray-200 whitespace-nowrap w-20">Medicine</label>
                <select name="medicine_id[]" id="medicine" class="select2-medicine w-full" multiple>
                    @if(!empty($selectedMedicines))
                        @foreach($selectedMedicines as $medicine)
                            <option value="{{ $medicine->id }}" selected>{{ $medicine->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <!-- Filter Button -->
        <div class="lg:col-span-2">
            <button type="submit" class="w-full p-2 text-white bg-blue-500 rounded-md hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800">
                Filter
            </button>
        </div>
    </div>
</form>

<!-- Add custom styles to make Select2 match your theme -->
<style>
    .select2-container .select2-selection--multiple {
        min-height: 45px;
        border-color: rgb(209 213 219);
        border-radius: 0.375rem;
    }

    .dark .select2-container .select2-selection--multiple {
        background-color: rgb(31 41 55);
        border-color: rgb(75 85 99);
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        padding: 4px 4px;
    }

    .dark .select2-dropdown {
        background-color: rgb(31 41 55);
        color: rgb(209 213 219);
    }

    .dark .select2-search__field {
        background-color: rgb(17 24 39);
        color: rgb(209 213 219);
    }

    .dark .select2-results__option {
        color: rgb(209 213 219);
    }

    .dark .select2-results__option[aria-selected=true] {
        background-color: rgb(55 65 81);
    }

    .dark .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(59 130 246);
    }
</style>
                    <!--  filter button end -->
            <div class="border mt-5 border-gray-200 rounded-lg dark:border-gray-700">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                        <thead class="text-left">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Sr No.</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Date</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Ward</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Totals Items</th>
                                <th class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap dark:text-gray-200">Action</th>
                            </tr>
                        </thead>

                        <tbody class="border-t divide-y divide-gray-200 dark:divide-gray-700 dark:border-gray-700">
                            @foreach ($records as $record)
                                <tr class="border dark:border-gray-700">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->date }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->ward->ward_name }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->getTotalRecordsAttribute() }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap dark:text-gray-300">
                                        <span
                                            class="inline-flex pl-2 pr-2 ml-2 mr-2 -space-x-px overflow-hidden bg-white border rounded-md shadow-sm dark:bg-gray-700">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expense.edit', $record->id) }}"
                                                    class="text-blue-500 dark:text-blue-400 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expenseRecord.create', $record->id) }}"
                                                    class="font-bold text-yellow-500 dark:text-yellow-400 hover:underline">Create Record</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-[#d4e282] hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expense.show', $record->id) }}"
                                                    class="text-sm hover:underline">View Record</a>
                                            </button>

                                            <!--<button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expenseRecord.edit', $record->id) }}"
                                                    class="font-bold text-yellow-500 dark:text-yellow-400 hover:underline">Edit Record</a>
                                            </button>-->

                                            <!--<button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative">
                                                <form action="{{ route('expense.destroy', $record->id) }}" method="POST"
                                                    class="inline text-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 dark:text-red-400 hover:underline">Delete</button>-->
                                                </form>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="flex items-center justify-center gap-3 my-4 text-sm">
        <x-pagination :paginator="$records" />
        </div>
        </div>
    </div>

<div id="downloadModel" class="hidden fixed inset-0 z-50 overflow-hidden bg-black bg-opacity-50">
    <div class="relative w-11/12 max-w-3xl p-4 mx-auto my-32 bg-white rounded-md shadow-lg dark:bg-gray-800">
        <header class="flex items-center justify-between p-2">
            <h2 class="font-semibold">Download Expense Records</h2>
            <button id="closeModel" class="text-red-500 hover:text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>
        <form action="{{ route('expense.export-to-excel') }}" method="POST">
            @csrf
            <div class="p-2">
                <label for="start_date" class="block">From</label>
                <input type="date" name="start_date" id="start_date" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="p-2">
                <label for="end_date" class="block">To</label>
                <input type="date" name="end_date" id="end_date" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="p-2">
                <label for="ward" class="block">Ward</label>
                <select name="ward_id" id="ward" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="all">All Wards</option>
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <button type="submit"
                    class="w-full p-2 text-white bg-blue-500 rounded-md hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800">Download</button>
            </div>
        </form>
    </div>
</div>

<script>
    const downloadModel = document.getElementById('downloadModel');
    const closeModel = document.getElementById('closeModel');

    closeModel.addEventListener('click', () => {
        downloadModel.classList.add('hidden');
    });

    // by default the model from and to date will be current full month
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;
    const lastDay = new Date(year, month, 0).getDate();
    const firstDate = `${year}-${month}-01`;
    const lastDate = `${year}-${month}-${lastDay}`;

    document.getElementById('start_date').value = firstDate;
    document.getElementById('end_date').value = lastDate;
    window.addEventListener("load", function() {
        setTimeout(() => {
            document.getElementById('autofocus').focus();
        }, 50);  // Delay for 100ms
    });

</script>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2-ward').select2({
            placeholder: 'Select Wards',
            allowClear: true,
            ajax: {
                url: '{{ route("wards.search") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });

        $('.select2-medicine').select2({
            placeholder: 'Select Medicines',
            allowClear: true,
            ajax: {
                url: '{{ route("medicines.search") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
    });
</script>
@endpush

