<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Reader's Note</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    .glitch-text {
      position: relative;
      display: inline-block;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      animation: glitch-skew 1s infinite linear alternate-reverse;
    }

    .glitch-text::before,
    .glitch-text::after {
      content: attr(data-text);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      color: #fff;
      opacity: 0.8;
    }

    .glitch-text::before {
      color: #0ff;
      z-index: -1;
      transform: translate(-2px, -2px);
      animation: glitch-anim-1 1.5s infinite linear alternate;
    }

    .glitch-text::after {
      color: #ff00c8;
      z-index: -2;
      transform: translate(2px, 2px);
      animation: glitch-anim-2 1.5s infinite linear alternate-reverse;
    }

    @keyframes glitch-skew {
      0% { transform: skew(0deg); }
      100% { transform: skew(1deg); }
    }

    @keyframes glitch-anim-1 {
      0% { transform: translate(-1px, 0); }
      20% { transform: translate(-3px, 2px); }
      40% { transform: translate(-1px, -2px); }
      60% { transform: translate(-4px, 1px); }
      80% { transform: translate(-2px, -1px); }
      100% { transform: translate(-1px, 0); }
    }

    @keyframes glitch-anim-2 {
      0% { transform: translate(1px, 0); }
      20% { transform: translate(3px, -2px); }
      40% { transform: translate(1px, 2px); }
      60% { transform: translate(4px, -1px); }
      80% { transform: translate(2px, 1px); }
      100% { transform: translate(1px, 0); }
    }
@keyframes glitch1 {
    0% { transform: translate(0, 0); }
    20% { transform: translate(-2px, -1px); }
    40% { transform: translate(-1px, 1px); }
    60% { transform: translate(-3px, 0); }
    80% { transform: translate(-2px, 2px); }
    100% { transform: translate(0, 0); }
  }

  @keyframes glitch2 {
    0% { transform: translate(0, 0); }
    20% { transform: translate(2px, 1px); }
    40% { transform: translate(1px, -1px); }
    60% { transform: translate(3px, 0); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0, 0); }
  }

  .animate-glitch1 {
    animation: glitch1 0.8s infinite linear;
    z-index: -1;
  }

  .animate-glitch2 {
    animation: glitch2 0.8s infinite linear;
    z-index: -2;
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

/* Tailwind classes already do this, but if you want more animation */
@keyframes flash-border {
  0%   { box-shadow: 0 0 0 0 rgba(34, 255, 170, 1); }
  10%  { box-shadow: 0 0 0 0.8px rgba(34, 255, 170, 0.93); }
  20%  { box-shadow: 0 0 0 1.6px rgba(34, 255, 170, 0.86); }
  30%  { box-shadow: 0 0 0 2.4px rgba(34, 255, 170, 0.79); }
  40%  { box-shadow: 0 0 0 3.2px rgba(34, 255, 170, 0.72); }
  50%  { box-shadow: 0 0 0 4px rgba(34, 255, 170, 0.65); }
  60%  { box-shadow: 0 0 0 4.8px rgba(34, 255, 170, 0.58); }
  70%  { box-shadow: 0 0 0 5.6px rgba(34, 255, 170, 0.41); }
  80%  { box-shadow: 0 0 0 6.4px rgba(34, 255, 170, 0.28); }
  90%  { box-shadow: 0 0 0 7.2px rgba(34, 255, 170, 0.14); }
  100% { box-shadow: 0 0 0 8px rgba(34, 255, 170, 0); }
}



.ring-green-500 {
   animation: flash-border 2s ease-out infinite;
}


.flash {

}


  </style>
</head>

<body class="min-h-screen bg-black font-mono text-white px-4 pt-24">
  <div class="fixed w-full top-0 left-0 z-50">
    @include('header')
  </div>

<form id="filter-form" x-ref="form" method="GET" action="{{ route('read') }}" class="w-full space-y-1">
 
<!-- Top Bar -->
<div class="w-full flex flex-wrap md:flex-nowrap items-center justify-between px-4 py-2">
  <!-- Welcome -->
  <h2 class="glitch text-[20px]" data-text="Welcome Reader: Nix">Welcome Reader: Nix</h2>

  <!-- Status Navigation -->
  <div class="flex gap-2 items-center my-2 md:my-0">
    @php
      $statuses = ['ongoing' => 'Ongoing', 'completed' => 'Completed', 'archived' => 'Archived'];
      $activeStatus = request('status', session('status'));
    @endphp

    @foreach ($statuses as $key => $label)
      <a href="{{ route('read', array_merge(request()->all(), ['status' => $key])) }}"
         class="text-xs font-bold px-3 py-1 border rounded shadow 
                {{ $activeStatus === $key ? 'bg-purple-600 text-white border-purple-400' : 'bg-black text-white border-white hover:bg-purple-400 hover:text-black' }}">
        {{ $label }}
      </a>
    @endforeach
  </div>

  <!-- Total Notes -->
  <h2 class="glitch text-[20px]" data-text="Total Number of Notes: {{ $totalnotes }}">
    Total Number of Notes: {{ $totalnotes }}
  </h2>
</div>


  <!-- Row 1: Search, Category, Buttons -->
  <div class="w-full flex flex-wrap md:flex-nowrap items-center gap-2 px-4 py-2 bg-black text-white rounded shadow">
    <!-- Search Input -->
    <input type="text" name="search" value="{{ request('search', session('search')) }}" placeholder="Search..."
      class="flex-grow bg-black text-white shadow border border-white rounded py-1 px-2 focus:outline-none focus:ring-2 focus:ring-white text-sm font-bold" />

    <input type="hidden" name="out_cat" id="out_cat" value="{{ request('out_cat') }}">

    <!-- Category Dropdown -->
    <div class="min-w-[150px]">
      <select name="category" id="category"
        class="w-full bg-black text-white border border-white rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-white">
        <option value="">-- Category --</option>
        @foreach ($CategoryModel as $ctgry)
          <option value="{{ $ctgry->category }}" {{ request('category', session('category')) == $ctgry->category ? 'selected' : '' }}>
            {{ $ctgry->category }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Buttons -->
    <div class="flex gap-1">
      <button type="submit"
        class="bg-black text-green-400 border border-white font-bold py-1 px-3 rounded shadow hover:text-green-300 hover:border-green-400 text-sm">
        Search
      </button>
      <a href="{{ url('/read/reset-filters') }}"
        class="bg-black text-red-400 border border-white font-bold py-1 px-3 rounded shadow hover:text-red-300 hover:border-red-400 text-sm">
        Reset
      </a>
    </div>

<div class=" px-2 py-1 bg-black text-white rounded shadow"
       x-data="{ selectedLetter: '' }"
       x-init="selectedLetter = '{{ request('letter', session('letter')) }}'">
    
    <div class="flex flex-wrap gap-1">
      <button type="button"
        @click="selectedLetter = ''; $refs.letterInput.value = ''; $refs.form.submit()"
        :class="selectedLetter === '' 
          ? 'bg-purple-500 text-white border-purple-400' 
          : 'bg-black text-white border-white'"
        class="w-6 h-6 text-xs border rounded shadow hover:bg-purple-400 hover:text-black transition">
        All
      </button>
      @foreach (range('A', 'Z') as $char)
        <button type="button"
          @click="selectedLetter = '{{ $char }}'; $refs.letterInput.value = '{{ $char }}'; $refs.form.submit()"
          :class="selectedLetter === '{{ $char }}' 
            ? 'bg-purple-500 text-white border-purple-400' 
            : 'bg-black text-white border-white'"
          class="w-6 h-6 text-xs border rounded shadow hover:bg-purple-400 hover:text-black transition">
          {{ $char }}
        </button>
      @endforeach
    </div>
    <input type="hidden" name="letter" x-ref="letterInput" value="{{ request('letter', session('letter')) }}">
  </div>


  </div>
  <!-- Row 3: Genre Filter -->
  <div class="w-full px-.5 py-.25 bg-black text-white rounded shadow"
     x-data="{
  selectedGenres: {{ json_encode((array) request('genre', session('genre', []))) }},

         toggle(genre) {
           if (this.selectedGenres.includes(genre)) {
             this.selectedGenres = this.selectedGenres.filter(g => g !== genre);
           } else {
             this.selectedGenres.push(genre);
           }
         }
       }">
    <label class="block font-bold mb-1 text-xs uppercase tracking-wide">Filter by Genre</label>
    <div class="flex flex-wrap gap-1">
      @foreach ($GenreModel as $gnr)
  <button type="button"
    @click="toggle('{{ $gnr }}')"
    :class="selectedGenres.includes('{{ $gnr }}') 
      ? 'bg-blue-500 text-white border-blue-400' 
      : 'bg-black text-white border-white'"
    class="px-2 py-1 border rounded text-xs font-semibold shadow hover:bg-blue-400 hover:text-black transition">
    {{ $gnr }}
  </button>
@endforeach
    </div>

    <!-- Hidden inputs for selected genres -->
    <template x-for="genre in selectedGenres" :key="genre">
      <input type="hidden" name="genre[]" :value="genre">
    </template>
  </div>

</form>

 <div class="bg-black p-6 space-y-12">
  
  @php
    $statuses = ['ongoing' => 'Ongoing', 'completed' => 'Completed', 'archived' => 'Archived'];
    $groupedReads = $ReadModel->groupBy('status');
  @endphp

  @foreach ($statuses as $key => $label)
    @if(isset($groupedReads[$key]) && $groupedReads[$key]->isNotEmpty())
      <div>
        <h2 class="text-2xl font-bold text-white mb-6">{{ $label }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-7 gap-6">
             <!-- Add New Button -->
    <a href="{{ url('/add-to-read') }}" 
      class="relative inline-flex items-center justify-center px-6 py-3 font-bold text-white border-2 border-purple-500 rounded-md overflow-hidden group">
      <span class="absolute inset-0 w-full h-full transition-transform duration-300 ease-out transform translate-x-1 translate-y-1 bg-purple-600 group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
      <span class="absolute inset-0 w-full h-full bg-black border-2 border-white group-hover:opacity-0"></span>
      <span class="relative flex items-center justify-center">
        <i data-lucide="plus" class="w-7 h-7 z-10 text-white transition-all duration-100"></i>
      </span>
    </a>
          @foreach ($groupedReads[$key] as $read)
            <!-- CARD START -->
            <div id="note-{{ $read->id }}" class="bg-gray-900 border border-purple-600 rounded-2xl shadow-lg p-4 text-white">
              <div class="w-full h-50 overflow-hidden rounded-xl mb-4 relative">
                <!-- Top Right Buttons -->
                <div class="absolute top-2 right-2 flex flex-col gap-1 z-10">
                  <!-- Delete -->
                  <a href="{{ route('read.delete', $read->id) }}"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center transform scale-75 hover:scale-100 transition-transform duration-200">
                    <i data-lucide="trash" class="w-3.5 h-3.5"></i>
                  </a>

                  <!-- Full Edit -->
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
                    class="btn-extended-edit bg-green-500 hover:bg-green-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center transform scale-75 hover:scale-100 transition-transform duration-200">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                  </a>

                  <!-- Quick Edit -->
                  <button class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center transform scale-75 hover:scale-100 transition-transform duration-200"
                          data-id="{{ $read->id }}"
                          data-title="{{ $read->title }}"
                          data-chapter="{{ $read->chapter }}"
                          data-page="{{ $read->page }}"
                          data-coverphoto="{{ $read->coverphoto }}">
                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                  </button>
                </div>

                <!-- Cover Image -->
                <img src="{{ asset($read->coverphoto ? 'storage/' . $read->coverphoto : 'images/default.png') }}"
                     alt="{{ $read->title }}"
                     class="w-full h-full object-cover aspect-[2/3] transition-transform duration-300 hover:scale-105" />
              </div>

              <!-- Title + Copy -->
              <div class="flex items-center justify-between gap-2 mb-1">
                <h3 class="text-xs font-semibold text-white truncate leading-tight" id="title-{{ $read->id }}">{{ $read->title }}</h3>
                <button onclick="copyTitle('{{ $read->id }}')" class="text-purple-400 hover:text-purple-200 transition" title="Copy Title">
                  <i data-lucide="copy" class="w-4 h-4"></i>
                </button>
              </div>

              <p class="text-base text-purple-400 font-bold">
                Chapter: <span class="text-white chapter-span">{{ $read->chapter }}</span>
              </p>
            </div>
            <!-- CARD END -->
          @endforeach
        </div>
      </div>
    @endif
  @endforeach

  <!-- Toast Message -->
  <div id="toast" class="fixed bottom-6 right-6 bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg opacity-0 pointer-events-none transition-opacity duration-300 z-50">
    Copied!
  </div>
</div>

<script>
  function copyTitle(id) {
  const fullTitle = document.getElementById('title-' + id).innerText;
  const firstTitle = fullTitle.split(';')[0].trim(); // get first part only
  navigator.clipboard.writeText(firstTitle).then(() => {
    showToast("Copied!");
  }).catch(err => {
    console.error('Failed to copy title:', err);
  });
}

  function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.remove('opacity-0');
    toast.classList.add('opacity-100');

    setTimeout(() => {
      toast.classList.remove('opacity-100');
      toast.classList.add('opacity-0');
    }, 2000);
  }
</script>



  <!-- Modal -->
<div id="updateModal" role="dialog" aria-modal="true" aria-labelledby="modal-title"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50 font-mono">
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative text-white">
    
    <!-- Close Button -->
    <button id="closeModal"
            class="absolute top-2 right-2 text-white hover:text-red-400 text-2xl font-bold">&times;</button>

   

   <form id="updateForm" action="{{ route('read.update', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Hidden ID -->
    <input type="hidden" name="id" id="note_id" value="">

    <!-- Two-column Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Left Column: Title + Chapter -->
        <div>
           <h2 id="modal-title" class="text-center text-3xl font-bold mb-6 text-purple-400">Update Note</h2>

            <!-- Title Display -->
            <div class="mb-4">
                <label class="block font-bold text-white mb-1">Title:</label>
                <p id="note_title" class="text-xl text-purple-300 font-semibold"></p>
            </div>

            <!-- Chapter Input -->
    
<div class="mb-4">
    <label for="edit_chapter" class="block font-bold mb-2 text-white">Chapter</label>
    <input type="text" name="chapter" id="edit_chapter"
           class="w-full px-6 py-4 text-2xl bg-black text-white border border-purple-500 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
           required autofocus>
</div>

<div class="mb-4">
    <label for="edit_page" class="block font-bold mb-2 text-white">Page</label>
    <input type="text" name="page" id="edit_page"
           class="w-full px-6 py-4 text-2xl bg-black text-white border border-purple-500 rounded focus:outline-none focus:ring-2 focus:ring-purple-600">
</div>
             <div class="flex justify-center mt-6">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg transition-all duration-300">
            Update
        </button>
    </div>
        </div>

        <!-- Right Column: Cover Photo -->
        <div class="flex justify-center items-start">
            <div class="text-center">
                <label class="block font-bold text-white mb-2">Cover Photo:</label>
                <img id="note_coverphoto" src="" alt="Cover Photo"
                     class="w-64 h-96 object-cover border-2 border-purple-500 rounded shadow-md">
            </div>
        </div>

    </div>

    <!-- Submit Button -->
   
</form>
  </div>
</div>

@if(session('updated_id'))
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const updatedCard = document.getElementById('note-{{ session('updated_id') }}');
    if (updatedCard) {
      updatedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

      // Optionally highlight the card briefly
      updatedCard.classList.add('ring-4', 'ring-green-500');
      setTimeout(() => {
        updatedCard.classList.remove('ring-4', 'ring-green-500');
      }, 2000);
    }
  });
</script>
@endif
 <script>
  lucide.createIcons();

  const updateModal = document.getElementById('updateModal');
  const closeModal = document.getElementById('closeModal');
  const updateForm = document.getElementById('updateForm');
  const originalAction = updateForm.action;

function formatNoteTitle(rawTitle) {
  const titles = rawTitle.split(';').map(t => t.trim()).filter(Boolean);
  if (!titles.length) return '';

  // First title: bold + black
  let formatted = `<span class="font-bold text-gray-400 text-2xl">${titles[0]}</span>`;

  // Remaining titles in one line separated by semicolon
  if (titles.length > 1) {
    const rest = titles.slice(1).join('; ');
    formatted += `<br><span class="text-black text-base">${rest}</span>`;
  }

  return formatted;
}




  document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
      const id = this.dataset.id;
      const title = this.dataset.title;
      const chapter = this.dataset.chapter;
      const page = this.dataset.page;
      const coverphoto = this.dataset.coverphoto;

      updateForm.action = originalAction.replace('__ID__', id);
      document.getElementById('note_id').value = id;

      // Format and inject the title HTML
      document.getElementById('note_title').innerHTML = formatNoteTitle(title);

      document.getElementById('edit_chapter').value = chapter;
      document.getElementById('edit_page').value = page;
      document.getElementById('note_coverphoto').src = coverphoto
        ? 'storage/' + coverphoto
        : 'images/default.png';

      updateModal.classList.remove('hidden');
      setTimeout(() => {
        document.getElementById('edit_chapter').focus();
      }, 100);

      document.body.classList.add('overflow-hidden');
    });
  });

  closeModal.addEventListener('click', function () {
    updateModal.classList.add('hidden');
    updateForm.action = originalAction;
    document.body.classList.remove('overflow-hidden');
  });

  window.addEventListener('click', function (e) {
    if (e.target === updateModal) {
      updateModal.classList.add('hidden');
      updateForm.action = originalAction;
      document.body.classList.remove('overflow-hidden');
    }
  });
</script>



</body>
</html>