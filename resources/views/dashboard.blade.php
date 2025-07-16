<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest"></script>
  
  <style>
    body {
      background-color: #000000;
      font-family: 'Courier New', monospace;
    }

    .glitch {
      position: relative;
      color: white;
      font-size: 2rem;
      text-align: center;
      text-transform: uppercase;
      font-weight: bold;
      animation: glitch-skew 1s infinite linear alternate-reverse;
    }

    .glitch::before,
    .glitch::after {
      content: attr(data-text);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      color: #0ff;
      background: transparent;
      overflow: hidden;
      clip: rect(0, 900px, 0, 0);
    }

    .glitch::after {
      color: #f0f;
      left: 2px;
      animation: glitch-anim-1 1.5s infinite linear alternate-reverse;
    }

    .glitch::before {
      left: -2px;
      animation: glitch-anim-2 1s infinite linear alternate-reverse;
    }

    @keyframes glitch-skew {
      0% { transform: skew(0deg); }
      100% { transform: skew(2deg); }
    }

    @keyframes glitch-anim-1 {
      0% { clip: rect(42px, 9999px, 44px, 0); }
      100% { clip: rect(12px, 9999px, 90px, 0); }
    }

    @keyframes glitch-anim-2 {
      0% { clip: rect(52px, 9999px, 56px, 0); }
      100% { clip: rect(32px, 9999px, 86px, 0); }
    }


.glitch-box {
  position: relative;
  background-color: #111;
  color: #0ff;
  border: 2px solid #0ff;
  box-shadow: 0 0 10px #0ff;
  animation: glitch-box-anim 2s infinite linear alternate-reverse;
}

@keyframes glitch-box-anim {
  0% { box-shadow: 0 0 5px #0ff, 0 0 10px #f0f; }
  100% { box-shadow: 0 0 10px #f0f, 0 0 20px #0ff; }
}


  </style>
</head>
<body class="min-h-screen bg-black font-mono text-white px-4 pt-24">
  <!-- Fixed Header -->
  <div class="fixed w-full top-0 left-0 z-50">
    @include('header')
  </div>

 <h2 class="glitch mb-10 text-center text-[70px]" data-text="Dashboard">Dashboard</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 justify-center place-items-center">

       <div class="glitch-box rounded p-8 flex flex-col items-center justify-center w-[300px] h-[300px]">
    <h2 class="text-lg font-semibold mb-6 text-center text-white">Total Number of Notes</h2>
    <h2 class="font-bold text-center text-6xl text-white">{{ $totalnotes }}</h2>
</div>
       <div class="glitch-box rounded p-8 flex flex-col items-center justify-center w-[300px] h-[300px]">
    <h2 class="text-lg font-semibold mb-6 text-center text-white">Ongoing</h2>
    <h2 class="font-bold text-center text-6xl text-white">{{ $totalongoing }}</h2>
</div>
       <div class="glitch-box rounded p-8 flex flex-col items-center justify-center w-[300px] h-[300px]">
    <h2 class="text-lg font-semibold mb-6 text-center text-white">Archived</h2>
    <h2 class="font-bold text-center text-6xl text-white">{{ $totalarchived }}</h2>
</div>
       <div class="glitch-box rounded p-8 flex flex-col items-center justify-center w-[300px] h-[300px]">
    <h2 class="text-lg font-semibold mb-6 text-center text-white">Completed</h2>
    <h2 class="font-bold text-center text-6xl text-white">{{ $totalcompleted }}</h2>
</div>
        </div>

<div class="bg-black p-6">
     <h2 class="glitch mb-10 text-center text-[70px]" data-text="Recently Added">Recently Added</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-6">
     @foreach ($ReadModel as $read)
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-lg p-4 text-white">
    <div class="w-full h-48 overflow-hidden rounded-xl mb-4 relative">
      <!-- Container for vertical button alignment -->
      <div class="absolute top-2 right-2 flex flex-col gap-2 z-10">
  <a href="{{ route('read.delete', $read->id) }}" 
     class="bg-red-500 hover:bg-red-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center">
    <i data-lucide="trash" class="w-4 h-4"></i>
  </a>

@php
  $params = [
    'id' => $read->id,
    'title' => $read->title,
    'volume' => $read->volume,
    'chapter' => $read->chapter,
    'page' => $read->page,
    'author' => $read->author,
    'category' => $read->category,
    'genre' => $read->genre,
    'status' => $read->status,
  ];
@endphp

<a href="{{ url('fullviewedit') . '?' . http_build_query($params) }}"
   class="btn-extended-edit bg-green-500 hover:bg-green-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center">
   <i data-lucide="refresh-cw" class="w-4 h-4"></i>
</a>
  <button class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center"
          data-id="{{ $read->id }}"
          data-title="{{ $read->title }}"
          data-chapter="{{ $read->chapter }}"
          data-coverphoto="{{ $read->coverphoto }}">
    <i data-lucide="pencil" class="w-4 h-4"></i>
  </button>
</div>
      <img src="{{ asset($read->coverphoto ? 'storage/' . $read->coverphoto : 'images/default.png') }}"
           alt="{{ $read->title }}"
           class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
    </div>

    <h3 class="text-base font-semibold text-white mb-1 truncate">{{ $read->title }}</h3>
<p class="text-lg text-purple-400 font-bold">
  Chapter: <span class="text-white">{{ $read->chapter }}</span>
</p>   
  </div>
@endforeach
    </div>
  </div>

  <div class="bg-black p-6">
     <h2 class="glitch mb-10 text-center text-[70px]" data-text="Recently Updated">Recently Updated</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-6">
     @foreach ($ReadModels as $read)
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-lg p-4 text-white">
    <div class="w-full h-48 overflow-hidden rounded-xl mb-4 relative">
      <!-- Container for vertical button alignment -->
      <div class="absolute top-2 right-2 flex flex-col gap-2 z-10">
  <a href="{{ route('read.delete', $read->id) }}" 
     class="bg-red-500 hover:bg-red-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center">
    <i data-lucide="trash" class="w-4 h-4"></i>
  </a>

@php
  $params = [
    'id' => $read->id,
    'title' => $read->title,
    'volume' => $read->volume,
    'chapter' => $read->chapter,
    'page' => $read->page,
    'author' => $read->author,
    'category' => $read->category,
    'genre' => $read->genre,
    'status' => $read->status,
  ];
@endphp

<a href="{{ url('fullviewedit') . '?' . http_build_query($params) }}"
   class="btn-extended-edit bg-green-500 hover:bg-green-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center">
   <i data-lucide="refresh-cw" class="w-4 h-4"></i>
</a>
  <button class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center"
          data-id="{{ $read->id }}"
          data-title="{{ $read->title }}"
          data-chapter="{{ $read->chapter }}"
          data-coverphoto="{{ $read->coverphoto }}">
    <i data-lucide="pencil" class="w-4 h-4"></i>
  </button>
</div>
      <img src="{{ asset($read->coverphoto ? 'storage/' . $read->coverphoto : 'images/default.png') }}"
           alt="{{ $read->title }}"
           class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
    </div>

    <h3 class="text-base font-semibold text-white mb-1 truncate">{{ $read->title }}</h3>
<p class="text-lg text-purple-400 font-bold">
  Chapter: <span class="text-white">{{ $read->chapter }}</span>
</p>   
  </div>
@endforeach
    </div>
  </div>

 <script>
  lucide.createIcons();
</script>
 
</body>
</html>
