<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SetUp-Genre</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

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
@endphp
  
    <div class="fixed w-64">@include('sidebar')</div>

    <div id="mainContent" class="md:ml-64 min-h-screen bg-gray-100 p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Category Section -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
          <!-- Add Category Form -->
          <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="category">Category</label>
              <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" id="category" name="category" required @if ($lastInput === 'category') autofocus @endif>
            </div>
            <div class="flex justify-center space-x-4">
              <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-green-300" type="submit">Submit</button>
            </div>
          </form>
    
          <!-- Category Table -->
          <div class="overflow-x-auto mt-4">
            <table class="min-w-full table-auto border-collapse">
              <thead>
                <tr class="bg-blue-900 text-white">
                  <th class="hidden">Id</th>
                  <th class="px-4 py-2 border-b text-left">Category</th>
                  <th class="hidden">Created at</th>
                  <th class="hidden">Updated at</th>
                  <th class="px-4 py-2 border-b text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($CategoryModel as $data)
                  <tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">
                    <td class="hidden">{{ $data->id }}</td>
                    <td class="px-4 py-2 border-b text-start">{{ $data->category }}</td>
                    <td class="hidden">{{ $data->created_at }}</td>
                    <td class="hidden">{{ $data->updated_at }}</td>
                    <td class="px-4 py-2 border-b space-x-4">
                      <a href="{{ route('category.delete', $data->id) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</a>
                      <button class="btn-editcategory bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" data-id="{{ $data->id }}" data-category="{{ $data->category }}">Edit</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $CategoryModel->withQueryString()->links() }}
            </div>
          </div>
        </div>


<!-- Edit Category Modal -->
<div id="updatecategoryModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
    <!-- Close Button -->
    <button id="closecategoryModal" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl">&times;</button>
    
    <h2 class="text-2xl font-bold mb-6">Update Category</h2>
    
    <form id="updatecategoryForm" action="{{ route('category.update', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" id="category_id" value="">
      
      <div>
        <label class="block text-gray-700 font-bold mb-2" for="edit_category">Category</label>
        <input type="text" name="category" id="edit_category" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div class="flex justify-end mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
          Update
        </button>
      </div>
    </form>
  </div>
</div>



    
        <!-- Genre Section -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
          <!-- Genre Form -->
          <form action="{{ route('genre.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
              <label for="genre" class="block text-gray-700 font-bold mb-2">Genre</label>
              <input type="text" id="genre" name="genre" required @if ($lastInput === 'genre') autofocus @endif class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex justify-center">
              <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-green-300">Submit</button>
            </div>
          </form>
    
          <!-- Genre Table -->
          <div class="overflow-x-auto mt-4">
            <table class="min-w-full table-auto border-collapse">
              <thead>
                <tr class="bg-blue-900 text-white">
                  <th class="hidden">Id</th>
                  <th class="px-4 py-2 border-b text-left">Genre</th>
                  <th class="hidden">Created At</th>
                  <th class="hidden">Updated At</th>
                  <th class="px-4 py-2 border-b text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($GenreModel as $data)
                  <tr class="bg-white odd:bg-gray-100 hover:bg-gray-200">
                    <td class="hidden">{{ $data->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $data->genre }}</td>
                    <td class="hidden">{{ $data->created_at }}</td>
                    <td class="hidden">{{ $data->updated_at }}</td>
                    <td class="px-4 py-2 border-b space-x-4">
                      <a href="{{ route('genre.delete', $data->id) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</a>
                      <button type="button" class="btn-editgenre bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" data-id="{{ $data->id }}" data-genre="{{ $data->genre }}">Edit</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $GenreModel->withQueryString()->links() }}
            </div>
          </div>
        </div>
    

<!-- Update Genre Modal -->
<div id="updategenreModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
    <button id="closegenreModal" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl">&times;</button>
    <h2 class="text-2xl font-bold mb-6">Update Genre</h2>
    <form id="updategenreForm" action="{{ route('genre.update', ['id' => '__ID__']) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="genre_id">

      <div class="mb-4">
        <label for="edit_genre" class="block text-gray-700 font-bold mb-2">Genre</label>
        <input type="text" name="genre" id="edit_genre" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      <div class="flex justify-end">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

      </div>
    </div>
    
 
      <!------------------------------------------------------- -->

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