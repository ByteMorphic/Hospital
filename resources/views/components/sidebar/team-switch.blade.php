@props(['team'])

<form method="POST" action="{{ route('current-team.update') }}" x-data class="dark:bg-gray-800 dark:text-white">
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">

    <!-- Team Switch Component -->
    <button type="submit" class="flex items-center w-full p-2 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none">
        <div class="flex items-center w-full">
            @if (Auth::user()->currentTeam->id === $team->id)
                <svg class="me-2 h-5 w-5 text-green-400 dark:text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
            <span class="truncate">{{ $team->name }}</span>
        </div>
    </button>
</form>
