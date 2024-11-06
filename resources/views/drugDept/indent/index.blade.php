<x-drugdept.layout title="Indents List">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold text-center mb-4">Indents</h1>

        <div class="mb-4">
            <form action="{{ route('indents.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search by Medicine Name or Generic Name"
                    class="border border-gray-300 rounded py-2 px-4"
                    value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
        </div>

        <a href="{{ route('indents.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create New Indent</a>

        <div class="rounded-lg border border-gray-200 mt-4">
            <div class="overflow-x-auto rounded-t-lg">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="text-left">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sr No.</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Medicine Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Generic Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Quantity</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Indent Date</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 border-t">
                        @foreach($records as $indent)
                            <tr class="border">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $indent->medicine_name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $indent->generic_name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $indent->quantity }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $indent->indent_date }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    {{ ucfirst($indent->indent_status) }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    <form action="{{ route('indents.approve', $indent->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-500 hover:underline">Approve</button>
                                    </form>
                                    <form action="{{ route('indents.reject', $indent->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-red-500 hover:underline">Reject</button>
                                    </form>
                                    <form action="{{ route('indents.setPending', $indent->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-yellow-500 hover:underline">Set Pending</button>
                                    </form>
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
</x-drugdept.layout>
