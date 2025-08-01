<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SetUp-Genre</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <style>
    .glitch {
      position: relative;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      animation: glitch-skew 1s infinite linear alternate-reverse;
    }
    .glitch::before,
    .glitch::after {
      content: attr(data-text);
      position: absolute;
      top: 0;
      width: 100%;
      overflow: hidden;
      background: transparent;
      clip: rect(0, 900px, 0, 0);
    }
    .glitch::before {
      left: 2px;
      color: #0ff;
      animation: glitch-anim-1 2s infinite linear alternate-reverse;
    }
    .glitch::after {
      left: -2px;
      color: #f0f;
      animation: glitch-anim-2 1.5s infinite linear alternate-reverse;
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

<body class="bg-gray-900 flex items-center justify-center min-h-screen">

  @if($errors->any())
    <ul class="text-red-400 text-sm mb-4">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <!-- Fixed Header -->
  <div class="fixed w-full z-50">@include('header')</div>

  <!-- Main Container -->
  <div class="pt-24 relative w-full h-[calc(100vh-6rem)] px-4">
    <div class="bg-black shadow-lg rounded px-8 pt-6 pb-8 border-4 border-pink-500 h-full w-full">
      <h2 class="text-3xl text-center glitch mb-6" data-text="Genre">Genre</h2>

      <!-- Grid layout including input form + genre cards -->
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-4">
        
        <!-- Input Form Styled Like Genre Card -->
        <div class="bg-gray-800 hover:bg-gray-800 transition rounded p-4 border border-pink-500 relative z-10">
          <form action="{{ route('genre.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <input type="text" id="genre" name="genre" required
                     class="w-full border border-pink-400 bg-black text-white rounded px-1.5 py-1 focus:outline-none focus:ring-2 focus:ring-pink-500"
                     placeholder="Enter genre name">
            </div>
            <div class="flex justify-center">
              <button type="submit"
                      class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-.5 px-3 rounded transition-all duration-300">
                Submit
              </button>
            </div>
          </form>
        </div>

        <!-- Genre Cards -->
        @foreach($GenreModel as $data)
          <div class="bg-gray-800 hover:bg-pink-700 transition rounded p-4 border border-pink-500 relative z-10">
            <p class="text-white text-center font-semibold mb-2">{{ $data->genre }}</p>
            <div class="flex justify-center space-x-2">
              <a href="{{ route('genre.delete', $data->id) }}"
                 class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-1 px-3 rounded">
                Delete
              </a>
              <button type="button"
                      class="btn-editgenre bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-1 px-3 rounded"
                      data-id="{{ $data->id }}" data-genre="{{ $data->genre }}">
                Edit
              </button>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-4 text-white">
        {{ $GenreModel->withQueryString()->links() }}
      </div>
    </div>
  </div>

  <!-- Update Genre Modal -->
  <div id="updategenreModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
    <div class="bg-gray-900 border border-pink-500 rounded-lg shadow-xl w-full max-w-md p-6 relative">
      <button id="closegenreModal" class="absolute top-2 right-2 text-white hover:text-red-500 text-xl font-bold">&times;</button>
      <h2 class="text-2xl text-center font-bold text-white mb-4 glitch" data-text="Edit Genre">Edit Genre</h2>

      <form id="updategenreForm" method="POST" action="{{ route('genre.update', '__ID__') }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="genre_id" name="id">

        <div class="mb-4">
          <label for="edit_genre" class="block text-pink-400 mb-1">Genre Name</label>
          <input type="text" id="edit_genre" name="genre" required
                 class="w-full border border-pink-400 bg-black text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>

        <div class="flex justify-center">
          <button type="submit"
                  class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded transition-all duration-300">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const updategenreModal = document.getElementById('updategenreModal');
    const closegenreModal = document.getElementById('closegenreModal');
    const updategenreForm = document.getElementById('updategenreForm');

    document.querySelectorAll('.btn-editgenre').forEach(button => {
      button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const genre = button.getAttribute('data-genre');
        updategenreForm.action = updategenreForm.action.replace('__ID__', id);
        document.getElementById('genre_id').value = id;
        document.getElementById('edit_genre').value = genre;
        updategenreModal.classList.remove('hidden');
      });
    });

    closegenreModal?.addEventListener('click', () => {
      updategenreModal.classList.add('hidden');
      updategenreForm.action = updategenreForm.action.replace(/(\d+)$/, '__ID__');
    });

    window.addEventListener('click', e => {
      if (e.target === updategenreModal) {
        updategenreModal.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
