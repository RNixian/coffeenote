<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SetUp-Category</title>
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
  
<div class="fixed w-full z-50">@include('header')</div>
<div class="mt-20 relative w-full h-[calc(100vh-5rem)] px-4">
 <div class="bg-black shadow-lg rounded px-8 pt-6 pb-8 border-4 border-purple-800 h-full w-full">
      <h2 class="text-3xl text-center glitch mb-6" data-text="Category">Category</h2>

      <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 bg-gray-900 rounded-lg shadow-md border border-purple-800">
        @csrf
        <div class="mb-4">
          <input type="text" id="category" name="category" required
                 class="w-full border border-purple-800 bg-black text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                 placeholder="Enter category name">
        </div>
        <div class="flex justify-center">
          <button type="submit"
                  class="bg-purple-800 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded transition-all duration-300">
            Submit
          </button>
        </div>
      </form>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-4">
        @foreach($CategoryModel as $data)
          <div class="bg-gray-800 hover:bg-purple-600 transition rounded p-4 border border-purple-800">
            <p class="text-white text-center font-semibold mb-2">{{ $data->category }}</p>
            <div class="flex justify-center space-x-2">
              <a href="{{ route('category.delete', $data->id) }}"
                 class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-1 px-3 rounded">
                Delete
              </a>
              <button type="button"
                      class="btn-editcategory bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-1 px-3 rounded"
                      data-id="{{ $data->id }}" data-category="{{ $data->category }}">
                Edit
              </button>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-4 text-white">
        {{ $CategoryModel->withQueryString()->links() }}
      </div>
    </div>
  </div>
  </div>

<!-- Update Category Modal -->
<div id="updatecategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
  <div class="bg-gray-900 border-4 border-purple-500 shadow-lg rounded-lg p-8 w-full max-w-md relative">
    <button id="closecategoryModal" class="absolute top-2 right-2 text-white hover:text-red-500 text-2xl font-bold">&times;</button>
    <h2 class="text-2xl text-center text-white font-bold mb-6 glitch" data-text="Update Category">Update Category</h2>

    <form id="updatecategoryForm" method="POST" action="{{ route('category.update', ['id' => '__ID__']) }}" class="space-y-4">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="category_id">
      
      <div>
        <label for="edit_category" class="block text-white font-semibold mb-1">Category</label>
        <input type="text" name="category" id="edit_category" required
          class="w-full border border-blue-400 bg-black text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-center">
        <button type="submit"
          class="bg-purple-800 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded shadow-md transition-all duration-300">
          Update
        </button>
      </div>
    </form>
  </div>
</div>



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
</body>
</html>