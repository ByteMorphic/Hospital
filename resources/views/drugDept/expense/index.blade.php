<x-drugdept.layout title="Expense Records">
    <div class="container">
        <div class="container p-24 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center text-gray-900 dark:text-white">Expense History</h1>
            <a href="{{ route('expense.create') }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800" autofocus>New Expense</a>
                <!--  download Button -->
                <a href="javascript:void(0)"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800"
                    onclick="downloadModel.classList.remove('hidden')">Download</a>
            <br />
            <br />
            <div class="border border-gray-200 rounded-lg dark:border-gray-700">
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
        <x-drugdept.pagination :paginator="$records" />
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
    

</script>
</x-drugdept.layout>

