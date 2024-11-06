<nav class="px-3 py-4 space-y-2 overflow-y-auto">
    <x-sidebar.nav-link 
        href="/dashboard" 
        icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
        label="Dashboard" />
        
    <x-sidebar.dropdown 
        name="medicine"
        icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
        label="Medicine">
        <x-sidebar.dropdown-item href="{{ route('medicines.create') }}" label="Add New Item" />
        <x-sidebar.dropdown-item href="{{ route('medicines.index') }}" label="View All Items" />
        <x-sidebar.dropdown-item href="{{ route('medicines.total') }}" label="Total" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Generics"
        icon="M17.12 7.88l3.8 3.8c1.17 1.17 1.17 3.07 0 4.24l-3.2 3.2c-1.17 1.17-3.07 1.17-4.24 0l-3.8-3.8c-1.17-1.17-1.17-3.07 0-4.24l3.2-3.2c1.17-1.17 3.07-1.17 4.24 0zM6.88 16.12l-3.8-3.8c-1.17-1.17-1.17-3.07 0-4.24l3.2-3.2c1.17-1.17 3.07-1.17 4.24 0l3.8 3.8c1.17 1.17 1.17 3.07 0 4.24l-3.2 3.2c-1.17 1.17-3.07 1.17-4.24 0z"
        label="Generics">
        <x-sidebar.dropdown-item href="{{ route('generics.create') }}" label="New Generic" />
        <x-sidebar.dropdown-item href="{{ route('generics.index') }}" label="View All" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Expense"
        icon="M5 3h14c1.104 0 2 .896 2 2v14c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2zM7 6h10M7 10h10M7 14h10M7 18h10"
        label="Expense">
        <x-sidebar.dropdown-item href="{{ route('expense.create') }}" label="Add New" />
        <x-sidebar.dropdown-item href="{{ route('expense.index') }}" label="History" />
        {{-- <x-sidebar.dropdown-item href="{{ route('expense.index') }}" label="Report" /> --}}
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Wards"
        icon="M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1zM7 7h10v10H7V7z"
        label="Wards">
        <x-sidebar.dropdown-item href="{{ route('wards.create') }}" label="Add New" />
        <x-sidebar.dropdown-item href="{{ route('wards.index') }}" label="View All Wards" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Manage Account"
        icon="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12zm0 1.5c-3.05 0-9 1.525-9 4.5V21h18v-3c0-2.975-5.95-4.5-9-4.5z"
        label="Manage Account">
        <x-sidebar.dropdown-item href="{{ route('profile.show') }}" label="Profile" />
        <x-sidebar.dropdown-item href="{{ route('api-tokens.index') }}" label="Api Tokens" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="{{ Auth::user()->currentTeam->name }}"
        icon="M12 14c3.314 0 6-2.686 6-6S15.314 2 12 2 6 4.686 6 8s2.686 6 6 6zM12 14c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z"
        label="Manage Team">
        <x-sidebar.dropdown-item href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" label="Team Setting" />
        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-sidebar.dropdown-item href="{{ route('teams.create') }}" label="Create New Team" />
        @endcan
        @if (Auth::user()->allTeams()->count() > 1)
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Switch Teams') }}
        </div>
        @foreach (Auth::user()->allTeams() as $team)
            <x-sidebar.team-switch :team="$team" />
        @endforeach
        @endif
    </x-sidebar.dropdown>




    {{-- Add other dropdowns similarly --}}
    
    <x-sidebar.nav-link 
        href="/settings" 
        icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"
        label="Settings" />
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        
            <button type="submit" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 group">
                <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span x-show="!isSidebarMinimized">Logout</span>
            </button>
        </form>
</nav>