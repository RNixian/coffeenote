<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Reader's Note</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
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

  </style>
</head>

<body class="min-h-screen bg-black font-mono text-white px-4 pt-24">
  <div class="fixed w-full top-0 left-0 z-50">
    @include('header')
  </div>

 <form id="filter-form" method="GET" action="{{ route('read') }}" class="w-full">
  <div class="w-full flex flex-wrap md:flex-nowrap items-center gap-4 px-4 py-4 bg-black text-white rounded shadow">

    <!-- Search Input -->
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
      class="flex-grow bg-black text-white shadow border border-white rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-white font-bold" />

    <input type="hidden" name="out_cat" id="out_cat" value="{{ request('out_cat') }}">

    <!-- Category Dropdown -->
    <div class="min-w-[180px]">
      <select name="category" id="category"
        class="w-full bg-black text-white border border-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-white">
        <option value="">-- Select Category --</option>
        @foreach ($CategoryModel as $ctgry)
          <option value="{{ $ctgry->category }}" {{ request('category') == $ctgry->category ? 'selected' : '' }}>
            {{ $ctgry->category }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Genre Dropdown -->
    <div class="min-w-[180px]">
      <select name="genre" id="genre"
        class="w-full bg-black text-white border border-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-white">
        <option value="">-- Select Genre --</option>
        @foreach ($GenreModel as $gnr)
          <option value="{{ $gnr->genre }}" {{ request('genre') == $gnr->genre ? 'selected' : '' }}>
            {{ $gnr->genre }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Buttons -->
   <div class="flex gap-2 mt-6 md:mt-0">
  <button type="submit"
    class="bg-black text-green-400 border border-white font-bold py-2 px-4 rounded shadow hover:text-green-300 hover:border-green-400">
    Search
  </button>
  <a href="{{ url('/read') }}"
    class="bg-black text-red-400 border border-white font-bold py-2 px-4 rounded shadow hover:text-red-300 hover:border-red-400">
    Reset
  </a>
</div>

  </div>
</form>



  <div class="bg-black p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
   <a href="{{ url('/add-to-read') }}" 
   class="relative inline-flex items-center justify-center px-6 py-3 font-bold text-white border-2 border-purple-500 rounded-md overflow-hidden group">
  
  <!-- Purple animated shadow background -->
  <span class="absolute inset-0 w-full h-full transition-transform duration-300 ease-out transform translate-x-1 translate-y-1 bg-purple-600 group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
  
  <!-- Black main background -->
  <span class="absolute inset-0 w-full h-full bg-black border-2 border-white group-hover:opacity-0"></span>
  
  <!-- Glitchy Icon Container -->
  <span class="relative flex items-center justify-center">
    <!-- Main icon -->
    <i data-lucide="plus" class="w-7 h-7 z-10 text-white transition-all duration-100"></i>

    <!-- Glitch shadows (only visible on hover) -->
    <i data-lucide="plus" class="w-7 h-7 absolute top-0 left-0 text-pink-500 opacity-0 group-hover:opacity-80 animate-glitch2 pointer-events-none"></i>
    <i data-lucide="plus" class="w-7 h-7 absolute top-0 left-0 text-purple-400 opacity-0 group-hover:opacity-80 animate-glitch1 pointer-events-none"></i>
  </span>
</a>



     @foreach ($ReadModel as $read)
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-lg p-4 text-white">
    <div class="w-full h-48 overflow-hidden rounded-xl mb-4 relative">
      <!-- Container for vertical button alignment -->
      <div class="absolute top-2 right-2 flex flex-col gap-2 z-10">
  <a href="{{ route('read.delete', $read->id) }}" 
     class="bg-red-500 hover:bg-red-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center">
    <i data-lucide="trash" class="w-4 h-4"></i>
  </a>

<a href="javascript:void(0);"
   class="btn-extended-edit bg-green-500 hover:bg-green-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center"
   data-id="{{ $read->id }}"
   data-title="{{ $read->title }}"
   data-volume="{{ $read->volume }}"
   data-chapter="{{ $read->chapter }}"
   data-page="{{ $read->page }}"
   data-author="{{ $read->author }}"
   data-category="{{ $read->category }}"
   data-genre="{{ $read->genre }}"
   data-status="{{ $read->status }}">

   <i data-lucide="refresh-cw" class="w-4 h-4"></i>
</a>


  <button class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-bold rounded w-8 h-8 flex items-center justify-center"
          data-id="{{ $read->id }}"
          data-title="{{ $read->title }}"
          data-chapter="{{ $read->chapter }}">
    <i data-lucide="pencil" class="w-4 h-4"></i>
  </button>
</div>
      <img src="{{ asset($read->coverphoto ? 'storage/' . $read->coverphoto : 'images/default.png') }}"
           alt="{{ $read->title }}"
           class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
    </div>

    <h3 class="text-xl font-bold mb-1 truncate">{{ $read->title }}</h3>
    <p class="text-sm text-purple-400">Chapter: <span class="font-medium text-white">{{ $read->chapter }}</span></p>
    
   
  </div>
@endforeach

    </div>
  </div>

  <!-- Modal -->
<div id="updateModal" role="dialog" aria-modal="true" aria-labelledby="modal-title"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50 font-mono">
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative text-white">
    
    <!-- Close Button -->
    <button id="closeModal"
            class="absolute top-2 right-2 text-white hover:text-red-400 text-2xl font-bold">&times;</button>

    <h2 id="modal-title" class="text-3xl font-bold mb-6 text-purple-400">Update Note</h2>

    <form id="updateForm" action="{{ route('read.update', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="note_id" value="">

      <div class="mb-4">
        <label for="edit_title" class="block font-bold mb-2 text-white">Title</label>
        <input type="text" name="title" id="edit_title"
               class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
               required>
      </div>

      <div class="mb-4">
        <label for="edit_chapter" class="block font-bold mb-2 text-white">Chapter</label>
        <input type="text" name="chapter" id="edit_chapter"
               class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
               required autofocus>
      </div>

      <div class="mb-4">
        <label for="edit_coverphoto" class="block font-bold mb-2 text-white">Cover Photo</label>
        <input type="file" name="coverphoto" id="edit_coverphoto"
               class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
               accept="image/jpeg,image/png,image/jpg">
      </div>

      <div class="flex justify-end">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg transition-all duration-300">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Extended Update Modal -->
<div id="extendedUpdateModal" role="dialog" aria-modal="true" aria-labelledby="extended-modal-title"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50 font-mono">
  <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-2xl w-full max-w-3xl p-6 relative text-white">

    <!-- Close Button -->
    <button id="closeExtendedModal"
            class="absolute top-2 right-2 text-white hover:text-red-400 text-2xl font-bold">&times;</button>

    <h2 id="extended-modal-title" class="text-3xl font-bold mb-6 text-purple-400">Edit Extended Note</h2>

    <form id="extendedUpdateForm" action="{{ route('read.update', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="extended_note_id" value="">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div>
          <label for="extended_title" class="block font-bold mb-1">Title</label>
          <input type="text" name="title" id="extended_title" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded focus:ring-purple-600" required autofocus>
        </div>

        <!-- Volume -->
        <div>
          <label for="extended_volume" class="block font-bold mb-1">Volume</label>
          <input type="text" name="volume" id="extended_volume" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
        </div>

        <!-- Chapter -->
        <div>
          <label for="extended_chapter" class="block font-bold mb-1">Chapter</label>
          <input type="text" name="chapter" id="extended_chapter" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
        </div>

        <!-- Page -->
        <div>
          <label for="extended_page" class="block font-bold mb-1">Page</label>
          <input type="text" name="page" id="extended_page" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
        </div>

        <!-- Author -->
        <div>
          <label for="extended_author" class="block font-bold mb-1">Author</label>
          <input type="text" name="author" id="extended_author" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
        </div>

        <!-- Cover Photo -->
        <div>
          <label for="extended_coverphoto" class="block font-bold mb-1">Cover Photo</label>
          <input type="file" name="coverphoto" id="extended_coverphoto" accept="image/jpeg,image/png,image/jpg,image/gif"
                 class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
        </div>

        <!-- Category Dropdown -->
       <div>
          <label for="extended_category" class="block font-bold">Category</label>
          <select name="category" id="extended_category" class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Select Category --</option>
            @foreach ($CategoryModel as $ctgry)
              <option value="{{ $ctgry->category }}" {{ request('category') == $ctgry->category ? 'selected' : '' }}>{{ $ctgry->category }}</option>
            @endforeach
          </select>
        </div>
        <!-- Genre Dropdown -->
        <div>
          <label for="extended_genre" class="block font-bold">Genre</label>
          <select name="genre" id="extended_genre" class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Select Genre --</option>
            @foreach ($GenreModel as $gnr)
              <option value="{{ $gnr->genre }}" {{ request('genre') == $gnr->genre ? 'selected' : '' }}>{{ $gnr->genre }}</option>
            @endforeach
          </select>
        </div>

        <!-- Status Dropdown -->
        <div class="md:col-span-2">
          <label for="extended_status" class="block font-bold mb-1">Status</label>
          <select name="status" id="extended_status"
                  class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
            <option value="">Select Status</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
            <option value="archived">Archived</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg transition-all duration-300">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>




  <script>
    lucide.createIcons();

    const updateModal = document.getElementById('updateModal');
    const closeModal = document.getElementById('closeModal');
    const updateForm = document.getElementById('updateForm');
    const originalAction = updateForm.action;

    document.querySelectorAll('.btn-edit').forEach(button => {
      button.addEventListener('click', function () {
        const id = this.dataset.id;
        const title = this.dataset.title;
        const chapter = this.dataset.chapter;

        // Update form action and inputs
        updateForm.action = originalAction.replace('__ID__', id);
        document.getElementById('note_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_chapter').value = chapter;

        document.getElementById('updateModal').classList.remove('hidden');
setTimeout(() => {
  document.getElementById('edit_chapter').focus();
}, 100); // slight delay ensures element is rendered before focus

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
<script>
  const extendedModal = document.getElementById('extendedUpdateModal');
  const closeExtendedModal = document.getElementById('closeExtendedModal');
  const extendedForm = document.getElementById('extendedUpdateForm');
  const extendedAction = extendedForm.action;

  document.querySelectorAll('.btn-extended-edit').forEach(button => {
    button.addEventListener('click', function () {
      const id = this.dataset.id;
      const title = this.dataset.title || '';
      const volume = this.dataset.volume || '';
      const chapter = this.dataset.chapter || '';
      const page = this.dataset.page || '';
      const author = this.dataset.author || '';
      const category = this.dataset.category || '';
      const genre = this.dataset.genre || '';
      const status = this.dataset.status || '';

      // Fill form fields
      extendedForm.action = extendedAction.replace('__ID__', id);
      document.getElementById('extended_note_id').value = id;
      document.getElementById('extended_title').value = title;
      document.getElementById('extended_volume').value = volume;
      document.getElementById('extended_chapter').value = chapter;
      document.getElementById('extended_page').value = page;
      document.getElementById('extended_author').value = author;
      document.getElementById('extended_category').value = category;
      document.getElementById('extended_genre').value = genre;
      document.getElementById('extended_status').value = status;

      extendedModal.classList.remove('hidden');
      setTimeout(() => {
        document.getElementById('extended_title').focus();
      }, 100);

      document.body.classList.add('overflow-hidden');
    });
  });

  closeExtendedModal.addEventListener('click', function () {
    extendedModal.classList.add('hidden');
    extendedForm.action = extendedAction;
    document.body.classList.remove('overflow-hidden');
  });

  window.addEventListener('click', function (e) {
    if (e.target === extendedModal) {
      extendedModal.classList.add('hidden');
      extendedForm.action = extendedAction;
      document.body.classList.remove('overflow-hidden');
    }
  });
</script>


</body>
</html>
