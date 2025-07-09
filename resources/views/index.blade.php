<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    
 <nav id="navLinks"
      class="hidden absolute top-full left-0 w-full bg-black md:static md:flex md:items-center md:gap-4 md:w-auto transition-all duration-300">
      <ul class="flex flex-col md:flex-row md:items-center md:gap-6 w-full md:w-auto text-white font-semibold uppercase">
        <li>
          <a href="{{ url('/dashboard') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
            <i data-lucide="layout-dashboard" class="inline w-4 h-4 text-blue-400"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="{{ url('/read') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
            <i data-lucide="graduation-cap" class="inline w-4 h-4 text-yellow-400"></i> Reader's Note
          </a>
        </li>
        <li>
          <a href="{{ url('/setup') }}" class="block px-4 py-2 hover:text-blue-400 hover:bg-opacity-20 hover:bg-white rounded glitch-text">
            <i data-lucide="users" class="inline w-4 h-4 text-purple-400"></i> Set-Up
          </a>
        </li>
      </ul>
      
    </nav>

</body>
</html>