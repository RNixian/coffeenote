<!-- Load Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Toggle Button -->
<button id="toggleSidebar"
  class="fixed top-4 left-4 bg-yellow-300 text-black rounded p-1 w-9 h-9 flex items-center justify-center z-50 shadow-md md:hidden">
  ☰
</button>


<!-- Sidebar -->

<div id="sidebar"
class="fixed top-0 left-0 h-screen w-64 bg-blue-900 text-white p-4 shadow-md overflow-auto z-40 transform md:translate-x-0 -translate-x-full md:block transition-transform duration-300">
  <br><br>
  <div class="d-flex align-items-center">
    <img src="{{ asset('images/note7.png') }}" alt="Logo" style="height: auto; width: 500px; border: 2px solid white; border-radius: 5px;">
  </div>
  
  @if(session()->has('firstname'))
  {{-- Welcome message in the center when logged in --}}
  <div class="text-white fw-semibold">
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
      <i data-lucide="settings"></i> Admin: {{ session('firstname') }}
    </h2>  
  </div>
@endif

  <ul class="space-y-1">
    <li>
      <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 py-2 px-4 hover:bg-yellow-200 rounded">
        <i data-lucide="layout-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="{{ url('/read') }}" class="flex items-center gap-2 py-2 px-4 hover:bg-yellow-200 rounded">
        <i data-lucide="graduation-cap"></i> Reader's Note
      </a>
    </li>

      <a href="{{ url('/setup') }}" class="flex items-center gap-2 py-2 px-4 hover:bg-yellow-200 rounded">
        <i data-lucide="users"></i> Set-Up
      </a>
    </li>

</ul>

  
 
</div>
