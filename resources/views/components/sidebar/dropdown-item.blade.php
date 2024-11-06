@props(['href', 'label'])

<a href="{{ $href }}" 
   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
    {{ $label }}
</a>