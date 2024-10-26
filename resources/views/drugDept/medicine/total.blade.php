<x-drugdept.layout title="Total Used">
    <div class="container">
        <div class="container p-24 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center">Total Usage of medicine</h1>
            <br />
            <br />
            <form action="{{ route('medicines.total') }}" method="GET" class="mb-4">
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
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Old Quantity</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Total Used</th>
                            </tr>
                        </thead>
                        <tbody class="border-t divide-y divide-gray-200">
                            @foreach($medicines as $medicine)
                                <tr class="border">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->name }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->generic->generic_name }} </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->getResultAttribute() }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->getTotalUsedAttribute() }}</td>
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
    </div>
</x-drugdept.layout>