@extends('layouts.app')
@section('title', 'Create New Record')
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            height: auto;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }

        .input-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .input-group input,
        .input-group select {
            flex: 1 1 auto;
            min-width: 150px;
            max-width: 250px;
            padding: 0.5rem;
        }

        .input-group {
            white-space: nowrap;
        }

        .input-group input[type="number"] {
            width: 120px;
        }

        .input-group button {
            flex-shrink: 0;
        }

        @media only screen and (max-width: 768px) {
            .input-group input,
            .input-group select {
                min-width: 100px;
            }
        }

        @media only screen and (min-width: 769px) and (max-width: 1024px) {
            .input-group input,
            .input-group select {
                min-width: 120px;
                max-width: 220px;
            }
        }

        @media only screen and (min-width: 1025px) {
            .input-group input,
            .input-group select {
                min-width: 150px;
                max-width: 250px;
            }
        }

        /* Dark mode styles */
        .dark .select2-container--default .select2-selection--single {
            background-color: #374151;
            border-color: #4B5563;
        }

        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #D1D5DB;
        }

        .dark .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #4B5563;
        }

        .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #6B7280;
        }

        .dark .select2-dropdown {
            background-color: #374151;
            border-color: #4B5563;
        }

        .dark .select2-search__field {
            background-color: #4B5563;
            color: #D1D5DB;
        }
    </style>
    <div class="p-6 mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center text-gray-800 dark:text-white">Create New Record <span class="text-sm text-gray-400">({{ $expense->ward->ward_name }} - {{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }})</span></h1>
        <hr class="mb-6 border-gray-300 dark:border-gray-600">

        <a href="{{ route('expense.index') }}" class="inline-block px-4 py-2 mb-6 font-bold text-white bg-blue-600 rounded hover:bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-700" id="back-button">Back</a>

        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <form id="expenseForm" class="space-y-6" action="{{ route('expenseRecord.store') }}" method="POST">
                @csrf
                <input type="hidden" name="expense_id" value="{{ $expense_id }}">

                <div id="medicineFields" class="space-y-4"></div>

                <div class="text-center">
                    <button type="button" class="px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-800 dark:bg-green-500 dark:hover:bg-green-700" onclick="addMedicineField()">Add Medicine</button>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let medicineIndex = 0;
        let selectedMedicines = new Map();

        function addMedicineField() {
            let newField = `
                <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg input-group dark:bg-gray-700 dark:border-gray-600" id="medicineField_${medicineIndex}">
                    <input type="hidden" id="medicine_id_${medicineIndex}" name="medicine_id[]">

                    <div class="flex-1">
                        <label for="medicine_search_${medicineIndex}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search Medicine:</label>
                        <select id="medicine_search_${medicineIndex}" name="medicine_search[]" class="px-4 py-2 mt-1 border rounded-md medicine-select dark:bg-gray-700 dark:border-gray-600 dark:text-white"></select>
                    </div>

                    <div class="flex-1">
                        <label for="medicine_name_${medicineIndex}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicine Name:</label>
                        <input type="text" id="medicine_name_${medicineIndex}" name="medicine_name[]" class="px-4 py-2 mt-1 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly tabindex="-1">
                    </div>

                    <div class="flex-1">
                        <label for="generic_name_${medicineIndex}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Generic Name:</label>
                        <input type="text" id="generic_name_${medicineIndex}" name="generic_name[]" class="px-4 py-2 mt-1 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly tabindex="-1">
                    </div>

                    <div class="flex-1">
                        <label for="quantity_${medicineIndex}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity:</label>
                        <input type="number" id="quantity_${medicineIndex}" name="quantity[]" class="px-4 py-2 mt-1 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" min="1">
                    </div>

                    <div class="ml-4">
                        <button type="button" class="px-4 py-2 font-bold text-white bg-red-600 rounded hover:bg-red-800 dark:bg-red-500 dark:hover:bg-red-700" onclick="removeMedicineField(${medicineIndex})">Remove</button>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Available Quantity:</label>
                        <p id="available_quantity_${medicineIndex}" class="text-sm text-gray-600 dark:text-gray-400">--</p>
                    </div>
                </div>
            `;

            document.getElementById('medicineFields').insertAdjacentHTML('beforeend', newField);
            initializeSelect2(medicineIndex);
            medicineIndex++;
        }

        function removeMedicineField(index) {
            const medicineId = document.getElementById(`medicine_id_${index}`).value;
            if (medicineId) {
                selectedMedicines.delete(index);
            }
            document.getElementById(`medicineField_${index}`).remove();
            updateTotalItems();
        }

        function initializeSelect2(index) {
            const medicines = @json($medicines);
            const generics = {!! json_encode($generics) !!};
            const selectElement = $(`#medicine_search_${index}`);

            const options = medicines.map(med => {
                const generic = generics.find(gen => gen.id == med.generic_id);
                const displayText = `${med.name} (${generic ? generic.generic_name : ''}) - ${med.category} - ${med.strength} - ${med.route}`;
                return {
                    id: med.id,
                    text: displayText,
                    availableQuantity: med.quantity,
                    medicineName: med.name,
                    genericName: generic ? generic.generic_name : ''
                };
            });

            selectElement.select2({
                data: options,
                placeholder: 'Search for a medicine',
                allowClear: true,
                width: 'resolve'
            }).on('select2:open', function() {
                setTimeout(function() {
                    document.querySelector('.select2-search__field').focus();
                }, 0);
            }).on('select2:select', function(e) {
                const selectedData = e.params.data;
                const selectedId = selectedData.id;

                let isDuplicate = false;
                selectedMedicines.forEach((value, key) => {
                    if (value === selectedId && key !== index) {
                        isDuplicate = true;
                    }
                });
                if (isDuplicate) {
                    alert('This medicine has already been added.');
                    selectElement.val(null).trigger('change');
                    return;
                }

                selectedMedicines.set(index, selectedId);

                // Set hidden medicine ID
                document.getElementById(`medicine_id_${index}`).value = selectedId;

                // Set the medicine name
                document.getElementById(`medicine_name_${index}`).value = selectedData.medicineName;

                // Set the generic name
                document.getElementById(`generic_name_${index}`).value = selectedData.genericName;

                // Set available quantity
                document.getElementById(`available_quantity_${index}`).innerText = selectedData.availableQuantity;

                // Focus on quantity field after selection
                document.getElementById(`quantity_${index}`).focus();

                updateTotalItems();
            }).on('select2:unselect', function(e) {
                selectedMedicines.delete(index);

                document.getElementById(`medicine_id_${index}`).value = '';
                document.getElementById(`medicine_name_${index}`).value = '';
                document.getElementById(`generic_name_${index}`).value = '';
                document.getElementById(`available_quantity_${index}`).innerText = '--';

                updateTotalItems();
            });

            selectElement.val(null).trigger('change');
        }

        function updateTotalItems() {
            const medicineFields = document.querySelectorAll('#medicineFields .input-group');
            medicineFields.forEach((field, index) => {
                const selectElement = field.querySelector('select');
                if (selectElement) {
                    const currentValue = $(selectElement).val();
                    $(selectElement).select2('destroy').select2({
                        data: getMedicineOptions(),
                        placeholder: 'Search for a medicine',
                        allowClear: true,
                        width: 'resolve'
                    });
                    $(selectElement).val(currentValue).trigger('change');
                }
            });
        }

        function getMedicineOptions() {
            const medicines = @json($medicines);
            const generics = @json($generics);
            return medicines.map(med => {
                const generic = generics.find(gen => gen.id == med.generic_id);
                const displayText = `${med.name} (${generic ? generic.generic_name : ''}) - ${med.category} - ${med.strength} - ${med.route}`;
                return {
                    id: med.id,
                    text: displayText,
                    availableQuantity: med.quantity,
                    medicineName: med.name,
                    genericName: generic ? generic.generic_name : ''
                };
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            addMedicineField();
            addMedicineField();
            addMedicineField();
            addMedicineField();

            // Prevent focusing on readonly fields
            document.addEventListener('focusin', function(e) {
                if (e.target.readOnly) {
                    e.target.blur();
                    let focusableElements = Array.from(document.querySelectorAll('button, [href], input:not([readonly]), select, textarea, [tabindex]:not([tabindex="-1"])'));
                    let index = focusableElements.indexOf(e.target);
                    if (index > -1 && index < focusableElements.length - 1) {
                        focusableElements[index + 1].focus();
                    }
                }
            });

            // Prevent form submission on Enter key press in input fields
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA')) {
                    e.preventDefault();
                }
            });

            // Submit form only when Save button is focused and Enter is pressed
            document.querySelector('button[type="submit"]').addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('expenseForm').submit();
                }
            });

            // Handle form submission
            document.getElementById('expenseForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Remove empty fields before submitting
                const medicineFields = document.querySelectorAll('#medicineFields .input-group');
                medicineFields.forEach((field) => {
                    const medicineId = field.querySelector('input[name="medicine_id[]"]').value;
                    const quantity = field.querySelector('input[name="quantity[]"]').value;

                    if (!medicineId || !quantity) {
                        field.remove();
                    }
                });

                // Submit the form
                this.submit();
            });
        });

        // Shift + N to Add new Fields
        document.addEventListener('keydown', function (e) {
            if (e.key === 'N' && e.shiftKey) {
                addMedicineField();
            }
        });
        window.addEventListener("load", function() {
        setTimeout(() => {
            document.getElementById('back-button').focus();
        }, 100);  // Delay for 100ms
    });

    </script>
@endsection