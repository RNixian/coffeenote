<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New To Read</title>
  <script src="https://cdn.tailwindcss.com"></script>
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

  <!-- Page Container -->
  <div class="max-w-7xl mx-auto">
    <h2 class="glitch mb-10 text-center text-[70px]" data-text="Add New Read">Add New Read</h2>

    <form action="{{ route('addtoread.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-6 bg-gray-800 p-6 rounded-xl border border-purple-600">
      @csrf

      <!-- Column 1 -->
      <div class="space-y-4 p-2">
        <label for="title" class="block font-bold">Title</label>
        <textarea name="title" id="title" class="w-full h-40 px-3 py-2 bg-black border border-blue-500 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"></textarea>
      </div>

      <!-- Column 2 -->
      <div class="space-y-4 p-2">
        <div>
          <label for="volume" class="block font-bold">Volume</label>
          <input type="text" name="volume" id="volume" class="w-full px-3 py-2 bg-black border border-pink-500 rounded focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="chapter" class="block font-bold">Chapter</label>
          <input type="text" name="chapter" id="chapter" class="w-full px-3 py-2 bg-black border border-pink-500 rounded focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
        <div>
          <label for="page" class="block font-bold">Page</label>
          <input type="text" name="page" id="page" class="w-full px-3 py-2 bg-black border border-pink-500 rounded focus:outline-none focus:ring-2 focus:ring-pink-400">
        </div>
      </div>

      <!-- Column 3 -->
      <div class="space-y-4 p-2">
        <div>
          <label for="category" class="block font-bold">Category</label>
          <select name="category" id="category" class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Select Category --</option>
            @foreach ($CategoryModel as $ctgry)
              <option value="{{ $ctgry->category }}" {{ request('category') == $ctgry->category ? 'selected' : '' }}>{{ $ctgry->category }}</option>
            @endforeach
          </select>
        </div>

      <div>
  <label for="genre" class="block font-bold">Genre</label>
  <select name="genre[]" id="genre" multiple
    class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    @foreach ($GenreModel as $gnr)
      <option value="{{ $gnr->genre }}" 
        {{ is_array(request('genre')) && in_array($gnr->genre, request('genre')) ? 'selected' : '' }}>
        {{ $gnr->genre }}
      </option>
    @endforeach
  </select>
</div>


        <div>
          <label for="author" class="block font-bold">Author</label>
          <input type="text" name="author" id="author" class="w-full bg-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="hidden">
          <label for="status" class="block font-bold">Status</label>
          <input type="text" name="status" id="status" value="ongoing">
        </div>
      </div>

      <!-- Column 4 -->
      <div class="space-y-4 p-2">
        <div>
          <label for="coverphoto" class="block font-bold">Cover Photo</label>
          <input type="file" name="coverphoto" id="coverphoto" accept="image/*" onchange="previewCover(event)" class="w-full text-white">
        </div>

        <div id="preview" class="mt-2 hidden">
          <img id="coverPreview" src="#" alt="Cover Preview" class="w-20 h-20 object-cover rounded cursor-pointer hover:ring-2 hover:ring-blue-400 transition-all duration-300" onclick="openModal()">
        </div>
      </div>

      <!-- Full-width Submit -->
      <div class="md:col-span-4 mt-6 flex justify-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 font-bold rounded text-white shadow transition-all duration-300">Submit</button>
      </div>
    </form>
  </div>

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
</body>

</html>
