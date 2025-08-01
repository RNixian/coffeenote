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


    <h2 class="text-3xl font-bold mb-6 text-white">Full Edit Note</h2>

 <form id="extendedUpdateForm" action="{{ route('read.fullupdate', ['id' => $note->id]) }}" method="POST" enctype="multipart/form-data" class="w-full h-full p-3 bg-gray-900 rounded-xl space-y-1">
  @csrf
  @method('PUT')
  <input type="hidden" name="id" id="extended_note_id" value="{{ $note->id }}">

  <div class="flex flex-col md:flex-row gap-6">
    <!-- Left Container -->
    <div class="w-full md:w-1/3 bg-gray-800 p-6 rounded-xl border border-purple-600 space-y-4">
      <div>
        <label for="extended_title" class="block font-bold text-white">Title</label>
        <textarea name="title" id="extended_title" rows="4" class="w-full h-40 px-2 py-1 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none">{{ old('title', $note->title) }}</textarea>
      </div>

      <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-1">
          <label for="extended_chapter" class="block font-bold text-white">Chapter</label>
          <input type="text" name="chapter" id="extended_chapter" value="{{ old('chapter', $note->chapter) }}" class="w-full px-3 py-2 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>

        <div class="flex-1">
          <label for="extended_status" class="block font-bold text-white">Status</label>
          <select name="status" id="extended_status" class="w-full px-3 py-2 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
            @php $selectedStatus = old('status', $note->status ?? ''); @endphp
            <option value="ongoing" {{ $selectedStatus == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="completed" {{ $selectedStatus == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="archived" {{ $selectedStatus == 'archived' ? 'selected' : '' }}>Archived</option>
          </select>
        </div>
      </div>

      <!-- Cover Photo -->
      <div class="flex flex-col md:flex-row gap-6">
        <div>
          <label for="coverphoto" class="block font-bold text-white">Cover Photo</label>
          <input type="file" name="coverphoto" id="coverphoto" accept="image/*" onchange="previewCoverPhoto(event)" class="w-full text-white">
        </div>
        <div id="preview" class="mt-2">
          <img id="note_coverphoto" src="{{ $note->coverphoto ? asset('storage/' . $note->coverphoto) : asset('images/default.png') }}" alt="Cover Preview" class="w-20 h-20 object-cover rounded cursor-pointer hover:ring-2 hover:ring-blue-400 transition-all duration-300">
        </div>
      </div>
    </div>

    <!-- Right Container -->
    <div class="w-full md:w-2/3 bg-gray-800 p-6 rounded-xl border border-purple-600 space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
          <label for="extended_volume" class="block font-bold text-white">Volume</label>
          <input type="text" name="volume" id="extended_volume" value="{{ old('volume', $note->volume) }}" class="w-full px-3 py-2 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="extended_page" class="block font-bold text-white">Page</label>
          <input type="text" name="page" id="extended_page" value="{{ old('page', $note->page) }}" class="w-full px-3 py-2 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="extended_author" class="block font-bold text-white">Author</label>
          <input type="text" name="author" id="extended_author" value="{{ old('author', $note->author) }}" class="w-full px-3 py-2 bg-black border border-gray-300 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
          <label for="extended_category" class="block font-bold text-white">Category</label>
          <select name="category" id="extended_category" class="w-full bg-black border border-gray-300 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Select --</option>
            @foreach ($CategoryModel as $ctgry)
              <option value="{{ $ctgry->category }}" {{ old('category', $note->category) == $ctgry->category ? 'selected' : '' }}>{{ $ctgry->category }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Genre -->
      <div x-data="{
        selected: {{ json_encode(explode(',', old('genre', is_array($note->genre) ? implode(',', $note->genre) : $note->genre)) ?? []) }},
        toggle(genre) {
          if (this.selected.includes(genre)) {
            this.selected = this.selected.filter(g => g !== genre);
          } else {
            this.selected.push(genre);
          }
        }
      }">
        <label class="block font-bold text-white text-sm mb-1">Genre</label>
        <div class="flex flex-wrap gap-2">
          @foreach ($GenreModel as $gnr)
            <button
              type="button"
              class="px-1 py-.5 rounded border text-xs font-medium transition-all"
              :class="selected.includes('{{ $gnr->genre }}') 
                ? 'bg-white text-black border-black' 
                : 'bg-gray-800 text-gray-300 border-gray-600'"
              @click="toggle('{{ $gnr->genre }}')"
            >
              {{ $gnr->genre }}
            </button>
          @endforeach
        </div>

        <!-- Hidden inputs -->
        <template x-for="genre in selected" :key="genre">
          <input type="hidden" name="genre[]" :value="genre">
        </template>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="w-full flex justify-center mt-4">
    <button type="submit" class="bg-white border border-black text-black hover:bg-gray-200 px-6 py-3 font-bold rounded shadow transition-all duration-300">
      Save Changes
    </button>
  </div>
</form>


<script>
  function previewCoverPhoto(event) {
    const reader = new FileReader();
    reader.onload = () => {
      document.getElementById('note_coverphoto').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

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