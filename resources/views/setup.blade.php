<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SetUp-Genre</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
</head>
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
    color: #0ff;
    background: transparent;
    clip: rect(0, 900px, 0, 0);
  }

  .glitch::before {
    left: 2px;
    animation: glitch-anim-1 2s infinite linear alternate-reverse;
  }

  .glitch::after {
    left: -2px;
    color: #f0f;
    animation: glitch-anim-2 1.5s infinite linear alternate-reverse;
  }

  @keyframes glitch-skew {
    0% {
      transform: skew(0deg);
    }
    100% {
      transform: skew(2deg);
    }
  }

  @keyframes glitch-anim-1 {
    0% {
      clip: rect(42px, 9999px, 44px, 0);
    }
    100% {
      clip: rect(12px, 9999px, 90px, 0);
    }
  }

  @keyframes glitch-anim-2 {
    0% {
      clip: rect(52px, 9999px, 56px, 0);
    }
    100% {
      clip: rect(32px, 9999px, 86px, 0);
    }
  }
</style>


<body class="bg-gray-900 flex items-center justify-center min-h-screen">

  @if($errors->any())
  <ul>
  @foreach ($errors->all() as $error)
      <li>
  {{$error}}
      </li>
  @endforeach
  </ul>
  @endif

  @php
    $lastInput = session('last_input');
    session()->forget('last_input');
@endphp

  
<div class="fixed w-full z-50">
  @include('header')
</div>

<div class="mt-20 relative overflow-hidden">
  <!-- Left Arrow -->
  <button onclick="slideCarousel(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-purple-700 hover:bg-purple-900 text-white px-3 py-2 rounded-l shadow">
    &#10094;
  </button>

  <!-- Right Arrow -->
  <button onclick="slideCarousel(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-pink-700 hover:bg-pink-900 text-white px-3 py-2 rounded-r shadow">
    &#10095;
  </button>

  <!-- SLIDES CONTAINER -->
  <div id="carousel-wrapper" class="w-full relative">
    <!-- CATEGORY -->
    <div class="carousel-slide transition-all duration-500 ease-in-out">
      <div class="bg-black shadow-lg rounded px-8 pt-6 pb-8 border-4 border-purple-500">
        <h2 class="text-3xl text-center glitch mb-6" data-text="Category">Category</h2>
          <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-gray-900 rounded-lg shadow-md border border-purple-500">
            @csrf
            <div class="mb-4">
              <input type="text" id="category" name="category" required
                {{ $lastInput === 'category' ? 'autofocus' : '' }}
                class="w-full border border-blue-400 bg-black text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-center space-x-4">
              <button class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded shadow-md transition-all duration-300" type="submit">Submit</button>
            </div>
          </form>
          <div class="overflow-x-auto mt-6">
            <table class="min-w-full table-auto border-collapse text-white">
              <thead>
                <tr class="bg-gradient-to-r from-purple-800 via-pink-600 to-purple-800 text-white">
                  <th class="hidden">Id</th>
                  <th class="px-1 py-.5 border-b border-purple-500 text-left">Category</th>
                  <th class="hidden">Created at</th>
                  <th class="hidden">Updated at</th>
                  <th class="px-1 py-.5 border-b border-purple-500 text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($CategoryModel as $data)
                  <tr class="bg-gray-800 odd:bg-gray-700 hover:bg-purple-700 transition">
                    <td class="hidden">{{ $data->id }}</td>
                    <td class="px-1 py-.5 border-b border-purple-500">{{ $data->category }}</td>
                    <td class="hidden">{{ $data->created_at }}</td>
                    <td class="hidden">{{ $data->updated_at }}</td>
                    <td class="px-1 py-.5 border-b border-purple-500 space-x-4">
                      <a href="{{ route('category.delete', $data->id) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</a>
                      <button class="btn-editcategory bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" data-id="{{ $data->id }}" data-category="{{ $data->category }}">Edit</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4 text-white">
              {{ $CategoryModel->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>


      <div class="carousel-slide hidden transition-all duration-500 ease-in-out">
      <div class="bg-black shadow-lg rounded px-8 pt-6 pb-8 border-4 border-pink-500">
        <h2 class="text-3xl text-center glitch mb-6" data-text="Genre">Genre</h2>
          <form action="{{ route('genre.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-gray-900 rounded-lg shadow-md border border-pink-500">
            @csrf
            <div class="mb-4">
              <input type="text" id="genre" name="genre" required
                {{ $lastInput === 'genre' ? 'autofocus' : '' }}
                class="w-full border border-pink-400 bg-black text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="flex justify-center">
              <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded transition-all duration-300">Submit</button>
            </div>
          </form>
          <div class="overflow-x-auto mt-6">
            <table class="min-w-full table-auto border-collapse text-white">
              <thead>
                <tr class="bg-gradient-to-r from-pink-800 via-purple-600 to-pink-800 text-white">
                  <th class="hidden">Id</th>
                  <th class="px-1 py-.5 border-b border-pink-500 text-left">Genre</th>
                  <th class="hidden">Created At</th>
                  <th class="hidden">Updated At</th>
                  <th class="px-1 py-.5 border-b border-pink-500 text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($GenreModel as $data)
                  <tr class="bg-gray-800 odd:bg-gray-700 hover:bg-pink-700 transition">
                    <td class="hidden">{{ $data->id }}</td>
                    <td class="px-1 py-.5 border-b border-pink-500">{{ $data->genre }}</td>
                    <td class="hidden">{{ $data->created_at }}</td>
                    <td class="hidden">{{ $data->updated_at }}</td>
                    <td class="px-1 py-.5 border-b border-pink-500 space-x-4">
                      <a href="{{ route('genre.delete', $data->id) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</a>
                      <button type="button" class="btn-editgenre bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" data-id="{{ $data->id }}" data-genre="{{ $data->genre }}">Edit</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4 text-white">
              {{ $GenreModel->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>


<!-- Scroll Script -->
<script>
 let currentSlide = 0;

  function slideCarousel(direction) {
    const slides = document.querySelectorAll('.carousel-slide');
    
    // Hide current
    slides[currentSlide].classList.add('hidden');

    // Update index and wrap around
    currentSlide = (currentSlide + direction + slides.length) % slides.length;

    // Show new slide
    slides[currentSlide].classList.remove('hidden');
  }
  function scrollLeft(id) {
    const container = document.getElementById(id);
    container.scrollBy({ left: -600, behavior: 'smooth' });
  }

  function scrollRight(id) {
    const container = document.getElementById(id);
    container.scrollBy({ left: 600, behavior: 'smooth' });
  }


</script>



<!-- Category --><!-- Category --><!-- Category --><!-- Category --><!-- Category --><!-- Category --><!-- Category -->     
<script>
  // Get modal elements
  const updatecategoryModal = document.getElementById('updatecategoryModal');
  const closecategoryModal = document.getElementById('closecategoryModal');
  const updatecategoryForm = document.getElementById('updatecategoryForm');

  // When user clicks any "Edit" button
  document.querySelectorAll('.btn-editcategory').forEach(button => {
    button.addEventListener('click', function() {
      // Retrieve data attributes from the clicked button
      const id = this.getAttribute('data-id');
      const category = this.getAttribute('data-category');

      // Update the form action with the record id
      updatecategoryForm.action = updatecategoryForm.action.replace('__ID__', id);
      document.getElementById('category_id').value = id;
      // Populate form fields with current data
      document.getElementById('edit_category').value = category;

      // Show the modal
      updatecategoryModal.classList.remove('hidden');
    });
  });

  // Close the modal when close button is clicked
  closecategoryModal.addEventListener('click', function() {
    updatecategoryModal.classList.add('hidden');
    // Reset action placeholder for next use
    updatecategoryForm.action = updatecategoryForm.action.replace(/(\d+)$/, '__ID__');
  });

  // Close modal on clicking outside the modal content
  window.addEventListener('click', function(e) {
    if (e.target === updatecategoryModal) {
      updatecategoryModal.classList.add('hidden');
    }
  });
</script>
<!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre --><!-- Genre -->
<script>
// Get modal elements
const updategenreModal = document.getElementById('updategenreModal');
const closegenreModal = document.getElementById('closegenreModal');
const updategenreForm = document.getElementById('updategenreForm');

// When user clicks any "Edit" button
document.querySelectorAll('.btn-editgenre').forEach(button => {
button.addEventListener('click', function() {
// Retrieve data attributes from the clicked button
const id = this.getAttribute('data-id');
const genre = this.getAttribute('data-genre');

// Update the form action with the record id
updategenreForm.action = updategenreForm.action.replace('__ID__', id);
document.getElementById('genre_id').value = id;
// Populate form fields with current data
document.getElementById('edit_genre').value = genre;

// Show the modal
updategenreModal.classList.remove('hidden');
});
});

// Close the modal when close button is clicked
closegenreModal.addEventListener('click', function() {
updategenreModal.classList.add('hidden');
// Reset action placeholder for next use
updategenreForm.action = updategenreForm.action.replace(/(\d+)$/, '__ID__');
});

// Close modal on clicking outside the modal content
window.addEventListener('click', function(e) {
if (e.target === updategenreModal) {
updategenreModal.classList.add('hidden');
}
});
</script>
</body>
</html>