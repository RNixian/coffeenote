<!-- Load Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://unpkg.com/alpinejs" defer></script>

<!-- Header / Navbar (Glitch Style) -->
<header class="bg-black text-green-400 shadow-lg w-full fixed top-0 left-0 z-50 border-b-4 border-purple-500">
  <div class="flex items-center justify-between px-4 py-3 md:px-8 glitch-box">

    <!-- Left: Logo & Admin -->
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/note7.png') }}" alt="Logo" class="h-10 border-2 border-neon-blue rounded-md shadow-lg">
      @if(session()->has('firstname'))
        <span class="font-bold text-lg flex items-center gap-1 glitch-text tracking-widest uppercase">
          <i data-lucide="settings" class="w-5 h-5 text-pink-500"></i>
          Admin: {{ session('firstname') }}
        </span>
      @endif
    </div>

    <!-- Toggle Button for Mobile -->
    <button id="toggleNavbar"
      class="bg-pink-600 text-black font-bold rounded p-1 w-9 h-9 flex items-center justify-center md:hidden shadow-glitch">
      ☰
    </button>

    <!-- Navigation Links -->
    <nav id="navLinks"
      class="hidden absolute top-full left-0 w-full bg-black md:static md:flex md:items-center md:gap-4 md:w-auto transition-all duration-300">
      <ul class="flex flex-col md:flex-row md:items-center md:gap-6 w-full md:w-auto text-white font-semibold uppercase">
       <ul class="flex flex-col md:flex-row md:items-center md:gap-6 w-full md:w-auto text-white font-semibold uppercase">
  <li>
    <a href="{{ url('/') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
      <i data-lucide="layout-dashboard" class="inline w-4 h-4 text-blue-400"></i> Dashboard
    </a>
  </li>
  <li>
    <a href="{{ url('/read') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
      <i data-lucide="book-open-text" class="inline w-4 h-4 text-yellow-400"></i> Reader's Note
    </a>
  </li>
  <li>
    <a href="{{ url('/setup-category') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
      <i data-lucide="layers" class="inline w-4 h-4 text-purple-400"></i> Category
    </a>
  </li>
  <li>
    <a href="{{ url('/setup-genre') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
      <i data-lucide="music-2" class="inline w-4 h-4 text-purple-400"></i> Genre
    </a>
  </li>
</ul>

      </ul>
    </nav>
  </div>
</header>

<!-- Push content below header -->
<div class="mt-20"></div>

<!-- Custom Glitch Style -->
<style>
  .glitch-text {
    font-family: 'Courier New', Courier, monospace;
    text-shadow: 
      1px 1px 0 #00fff7, 
      -1px -1px 0 #ff00f7,
      2px 0 0 #00fff7;
  }

  .shadow-glitch {
    box-shadow: 0 0 10px #ff00f7, 0 0 20px #00fff7;
  }

  .border-neon-blue {
    border-color: #00fff7;
  }

  .text-neon-green {
    color: #39ff14;
  }

  .glitch-box {
    background-image: linear-gradient(to right, #111, #000);
    border-bottom: 2px solid #ff00f7;
  }
</style>

<!-- Initialize Lucide Icons -->
<script>
  lucide.createIcons();

  // Toggle mobile nav
  const toggleBtn = document.getElementById('toggleNavbar');
  const navLinks = document.getElementById('navLinks');
  toggleBtn.addEventListener('click', () => {
    navLinks.classList.toggle('hidden');
  });
</script>
