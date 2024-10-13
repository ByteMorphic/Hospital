<x-drugdept.layout title="HMS Sahiwal Teaching Hospital">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ">
    <!-- Hero Section -->
    <section class="py-20 text-white bg-gradient-to-r from-blue-600 to-indigo-700">
      <div class="container px-4 mx-auto text-center">
        <i class="mb-6 text-6xl fas fa-hospital-alt"></i>
        <h1 class="mb-4 text-4xl font-bold md:text-5xl">Welcome to Sahiwal Teaching Hospital</h1>
        <p class="mb-8 text-xl">Transforming healthcare with innovative solutions</p>
        @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="px-6 py-3 font-bold text-blue-600 transition duration-300 bg-white rounded-full hover:bg-blue-100">
            Manage Expenses
          </a>
        @else
          <a href="{{ route('login') }}" class="px-6 py-3 font-bold text-blue-600 transition duration-300 bg-white rounded-full hover:bg-blue-100">
            Login
          </a>
        @endif
      </div>
    </section>

    <!-- About Section -->
    <section class="py-16 text-gray-900 bg-white dark:bg-gray-900 dark:text-gray-300">
      <div class="container px-4 mx-auto text-center">
        <h2 class="mb-6 text-3xl font-bold">About Us</h2>
        <p class="max-w-2xl mx-auto leading-relaxed">
          At Sahiwal Teaching Hospital, we combine cutting-edge technology with compassionate care to provide exceptional healthcare services. Our dedicated team ensures personalized attention and optimal outcomes for every patient.
        </p>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 text-gray-800 bg-gray-100 dark:bg-gray-900 dark:text-gray-300">
      <div class="container px-4 mx-auto text-center">
        <h2 class="mb-12 text-3xl font-bold">Key Features</h2>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
          @foreach ([
            ['icon' => 'fas fa-user-md', 'title' => 'Patient Management', 'description' => 'Efficiently manage patient records, appointments, and medical history.'],
            ['icon' => 'fas fa-chart-line', 'title' => 'Data Analytics', 'description' => 'Gain insights from data to improve treatment efficacy and patient outcomes.'],
            ['icon' => 'fas fa-comments', 'title' => 'Secure Messaging', 'description' => 'Communicate securely with patients and staff without concerns.'],
          ] as $feature)
            <div class="p-6 rounded-lg shadow-md">
              <i class="{{ $feature['icon'] }} text-4xl text-blue-600 mb-4"></i>
              <h3 class="mb-2 text-xl font-semibold">{{ $feature['title'] }}</h3>
              <p class="text">{{ $feature['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="py-16 text-center bg-indigo-600">
      <div class="container px-4 mx-auto">
        <h2 class="mb-6 text-3xl font-bold text-white">Join Us Today!</h2>
        @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="px-6 py-3 font-bold text-indigo-600 transition duration-300 bg-white rounded-full hover:bg-indigo-100">
            Manage Expenses
          </a>
        @else
          <a href="{{ route('login') }}" class="px-6 py-3 font-bold text-indigo-600 transition duration-300 bg-white rounded-full hover:bg-indigo-100">
            Login
          </a>
        @endif
      </div>
    </section>
  </div>

  <style>
    @media (max-width: 768px) {
      .text-4xl {
        font-size: 2.5rem;
      }
      .text-xl {
        font-size: 1.25rem;
      }
    }
  </style>
</x-drugdept.layout>
