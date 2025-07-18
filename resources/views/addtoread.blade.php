<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New To Read</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  
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
  </style>
</head>
<body class="min-h-screen bg-black font-mono text-white px-4 pt-24">
  <!-- Fixed Header -->
  <div class="fixed w-full top-0 left-0 z-50">
    @include('header')
  </div>

    <form action="{{ route('addtoread.store') }}" method="POST" enctype="multipart/form-data" class="w-full h-full p-3 bg-gray-900 rounded-xl space-y-1">
  @csrf
 <h2 class="glitch mb-10 text-center text-[70px]" data-text="Add New To Read">Add New To Read</h2>
  <div class="flex flex-col md:flex-row gap-6">
    <!-- 1st Container - Left (30%) -->
    <div class="w-full md:w-1/3 bg-gray-800 p-6 rounded-xl border border-purple-600 space-y-4"> 
      <div>
        <label for="title" class="block font-bold text-white">Title</label>
        <textarea name="title" id="title" class="w-full h-40 px-3 py-2 bg-black border border-blue-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"></textarea>
      </div>
<div class="flex flex-col md:flex-row gap-2">
      <div>
        <label for="chapter" class="block font-bold text-white">Chapter</label>
        <input type="text" name="chapter" id="chapter" class="w-full px-3 py-2 bg-black border border-pink-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>

<div>
  <label for="status" class="block font-bold mb-1">Status</label>
    <select name="status" id="status" class="w-full px-3 py-2 bg-black border border-pink-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
      <option value="ongoing">Ongoing</option>
      <option value="completed">Completed</option>
      <option value="archived">Archived</option>
    </select>
</div>

</div>
      <div>
        <label for="coverphoto" class="block font-bold text-white">Cover Photo</label>
        <input type="file" name="coverphoto" id="coverphoto" accept="image/*" onchange="previewCover(event)" class="w-full text-white">
        <div id="preview" class="mt-2 hidden">
          <img id="coverPreview" src="#" alt="Cover Preview" class="w-20 h-20 object-cover rounded cursor-pointer hover:ring-2 hover:ring-blue-400 transition-all duration-300" onclick="openModal()">
        </div>
      </div>
    </div>

    <!-- 2nd Container - Right (70%) -->
    <div class="w-full md:w-2/3 bg-gray-800 p-6 rounded-xl border border-purple-600 space-y-6">
      
      <!-- Row 1: Volume and Page -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
          <label for="volume" class="block font-bold text-white">Volume</label>
          <input type="text" name="volume" id="volume" class="w-full px-3 py-2 bg-black border border-pink-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="page" class="block font-bold text-white">Page</label>
          <input type="text" name="page" id="page" class="w-full px-3 py-2 bg-black border border-pink-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="author" class="block font-bold text-white">Author</label>
          <input type="text" name="author" id="author" class="w-full bg-black border border-gray-300 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
          <label for="category" class="block font-bold text-white">Category</label>
          <select name="category" id="category" class="w-full bg-black border border-gray-300 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Select --</option>
            @foreach ($CategoryModel as $ctgry)
              <option value="{{ $ctgry->category }}" {{ request('category') == $ctgry->category ? 'selected' : '' }}>{{ $ctgry->category }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Row 3: Genre Buttons -->
     <div x-data="{
  selected: [],
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
        class="px-2 py-1 rounded border text-xs font-medium transition-all"
        :class="selected.includes('{{ $gnr->genre }}') 
          ? 'bg-black text-white border-gray-500' 
          : 'bg-gray-800 text-gray-300 border-gray-600'"
        @click="toggle('{{ $gnr->genre }}')"
      >
        {{ $gnr->genre }}
      </button>
    @endforeach
  </div>

  <!-- Hidden inputs to submit selected genres -->
  <div>
    <template x-for="genre in selected" :key="genre">
      <input type="hidden" name="genre[]" :value="genre">
    </template>
  </div>
</div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="w-full flex justify-center mt-4">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 font-bold rounded text-white shadow transition-all duration-300">
      Submit
    </button>
  </div>
</form>


  <!-- Modal Preview -->
<div id="modal" onclick="closeModal()" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex items-center justify-center">
  <div class="flex justify-center items-center">
    <img id="modalImage" src="#" alt="Cover Full Preview" class="max-w-3xl max-h-[90vh] rounded shadow-lg" />
  </div>
</div>

  <script>
    function previewCover(event) {
      const [file] = event.target.files;
      const preview = document.getElementById('coverPreview');
      const modalImage = document.getElementById('modalImage');
      const previewContainer = document.getElementById('preview');

      if (file) {
        const imageURL = URL.createObjectURL(file);
        preview.src = imageURL;
        modalImage.src = imageURL;
        previewContainer.classList.remove('hidden');
      }
    }

    function openModal() {
      document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }
  </script>

  <script>
  function genrePicker() {
    return {
      selected: @json(request('genre') ?? []),
      toggle(genre) {
        const index = this.selected.indexOf(genre);
        if (index > -1) {
          this.selected.splice(index, 1);
        } else {
          this.selected.push(genre);
        }
      }
    }
  }
</script>
</body>

</html>
