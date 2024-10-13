<x-drugdept.layout title="Wards">
    <div class="container">

        <div class="container p-4 mx-auto">
            <h1 class="text-2xl font-bold text-center mb-4">Edit Wards Details</h1>
            <a href="{{ URL::previous() }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
            <br />
            <br />
            <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md">
                <form method="POST" action="{{ route('wards.update', $ward->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="ward_name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Name
                        </label>
                        <input type="text" name="ward_name" id="ward_name" placeholder="Ward Name"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ $ward->ward_name }}" autofocus />
                        @error('ward_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_description" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Discription
                        </label>
                        <input type="text" name="ward_description" id="ward_description"
                            placeholder="Ward Description"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ $ward->ward_description }}" />
                        @error('ward_description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_capacity" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward Capacity
                        </label>
                        <input type="number" name="ward_capacity" id="ward_capacity" placeholder="Patient Capacity"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ $ward->ward_capacity }}" />
                        @error('ward_capacity')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_status" class="mb-3 block text-base font-medium text-[#07074D]">
                            Status
                        </label>
                        <input type="checkbox" name="ward_status" id="ward_status"
                            class="rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            {{ $ward->ward_status ? 'checked' : '' }} />
                    </div>

                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-drugdept.layout>
