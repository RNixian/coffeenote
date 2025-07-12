<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Reader's Note-Update</title>
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

  </style>
</head>

<body class="min-h-screen bg-black font-mono text-white px-4 pt-24">
  <div class="fixed w-full top-0 left-0 z-50">
    @include('header')
  </div>

 <div class="bg-gray-900 border border-purple-600 rounded-2xl shadow-2xl w-full px-6 py-8 text-white">


    <h2 class="text-3xl font-bold mb-6 text-purple-400">Edit Extended Note</h2>

  <form id="extendedUpdateForm" action="{{ route('read.fullupdate', ['id' => $note->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="extended_note_id" value="">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <!-- 1st Row: Title, Chapter, Page -->
 <div>
  <label for="extended_title" class="block font-bold mb-1">Title</label>
  <textarea name="title" id="extended_title" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded" required autofocus rows="3"></textarea>
</div>

 <div>
  <label for="extended_author" class="block font-bold mb-1">Author</label>
  <textarea name="author" id="extended_author" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded" autofocus rows="3"></textarea>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-4">
  <!-- 2nd Row: Volume, Author, Category -->
  <div>
    <label for="extended_chapter" class="block font-bold mb-1">Chapter</label>
    <input type="text" name="chapter" id="extended_chapter" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
  </div>

  <div>
    <label for="extended_page" class="block font-bold mb-1">Page</label>
    <input type="text" name="page" id="extended_page" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
  </div>

  <div>
    <label for="extended_volume" class="block font-bold mb-1">Volume</label>
    <input type="text" name="volume" id="extended_volume" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
  </div>

  <div>
    <label for="extended_category" class="block font-bold mb-1">Category</label>
    <select name="category" id="extended_category" class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
      <option value="">-- Select Category --</option>
      @foreach ($CategoryModel as $ctgry)
        <option value="{{ $ctgry->category }}" {{ request('category') == $ctgry->category ? 'selected' : '' }}>{{ $ctgry->category }}</option>
      @endforeach
    </select>
  </div>
 <div>
  <label for="extended_status" class="block font-bold mb-1">Status</label>
  @php $selectedStatus = old('status', $request->status ?? ''); @endphp

<select name="status" id="extended_status" class="w-full px-4 py-2 bg-black text-white border border-purple-500 rounded">
  <option value="ongoing" {{ $selectedStatus == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
  <option value="completed" {{ $selectedStatus == 'completed' ? 'selected' : '' }}>Completed</option>
  <option value="archived" {{ $selectedStatus == 'archived' ? 'selected' : '' }}>Archived</option>
</select>
</div>

</div>


<!-- 3rd Row: genre + coverphoto + Save Button -->
<div class="grid grid-cols-1 md:grid-cols-10 gap-4 mt-6 items-end">
  @php
    $selectedGenres = request()->input('genre', []);
    if (!is_array($selectedGenres)) {
      $selectedGenres = explode(',', $selectedGenres);
    }
  @endphp

  <!-- Genre Section (70%) -->
  <div class="mt-4 md:col-span-7"
       x-data="{
         genres: {{ json_encode($GenreModel->pluck('genre')) }},
         selectedGenres: {{ json_encode($selectedGenres) }},
         toggle(genre) {
           if (this.selectedGenres.includes(genre)) {
             this.selectedGenres = this.selectedGenres.filter(g => g !== genre);
           } else {
             this.selectedGenres.push(genre);
           }
         }
       }">

    <label for="extended_genre" class="block font-bold mb-1">Genre</label>
    <div class="flex flex-wrap gap-1">
      <template x-for="genre in genres" :key="genre">
        <button
          type="button"
          @click="toggle(genre)"
          :class="selectedGenres.includes(genre)
            ? 'bg-blue-500 text-white border-blue-400'
            : 'bg-black text-white border-white'"
          class="px-2 py-1 border rounded text-xs font-semibold shadow hover:bg-blue-400 hover:text-black transition"
          x-text="genre">
        </button>
      </template>
    </div>

    <!-- Hidden inputs -->
    <template x-for="genre in selectedGenres" :key="genre">
      <input type="hidden" name="genre[]" :value="genre">
    </template>
  </div>

  <!-- Cover Photo Section (20%) -->
<div class="text-left md:col-span-2">
  <label class="block font-bold mb-1">Cover Image</label>
  <input type="file" name="coverphoto" accept="image/*"
         class="w-full mt-1 border p-1 text-sm rounded"
         onchange="previewCoverPhoto(event)" />
  <img id="note_coverphoto"
       src="{{ $note->coverphoto ? asset('storage/' . $note->coverphoto) : asset('images/default.png') }}"
       alt="Cover Photo Preview"
       class="mx-auto mb-2 w-32 h-32 object-cover rounded border" />
</div>


  <!-- Submit Button Section (10%) -->
  <div class="flex justify-end mt-2 md:mt-0 md:col-span-1">
    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg transition-all duration-300 w-full md:w-auto">
      Save Changes
    </button>
  </div>
</div>

<script>
  function previewCoverPhoto(event) {
    const reader = new FileReader();
    reader.onload = () => {
      document.getElementById('note_coverphoto').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

    </form>
  </div>

<script>
// Helper function to get URL query parameters
function getQueryParam(name) {
  return new URLSearchParams(window.location.search).get(name) || '';
}

// Preview selected cover photo
function previewCoverPhoto(event) {
  const reader = new FileReader();
  reader.onload = () => {
    document.getElementById('note_coverphoto').src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}

window.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('extendedUpdateForm');
  const id = getQueryParam('id');

  if (form && id) {
    document.getElementById('extended_note_id').value = id;
  }

  // Populate standard inputs
  document.getElementById('extended_title').value = getQueryParam('title');
  document.getElementById('extended_volume').value = getQueryParam('volume');
  document.getElementById('extended_chapter').value = getQueryParam('chapter');
  document.getElementById('extended_page').value = getQueryParam('page');
  document.getElementById('extended_author').value = getQueryParam('author');
  document.getElementById('extended_category').value = getQueryParam('category');
  document.getElementById('extended_status').value = getQueryParam('status');

  // Populate genre selections (multi-select)
  const genreParam = getQueryParam('genre');
  if (genreParam) {
    const genres = genreParam.split(',');
    const select = document.getElementById('extended_genre');
    Array.from(select.options).forEach(opt => {
      if (genres.includes(opt.value)) {
        opt.selected = true;
      }
    });
  }
});
</script>

</body>
</html>