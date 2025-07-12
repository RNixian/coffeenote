<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\GenreModel;
use App\Models\CategoryModel;
use App\Models\ReadModel;

class ReadController extends Controller
{
    // ADD FORM
    public function addtoread()
    {
        $CategoryModel = CategoryModel::all();
        $GenreModel = GenreModel::all();

        return view('addtoread', compact('GenreModel', 'CategoryModel'));
    }

    // STORE NEW NOTE
   public function storetoread(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'volume' => 'nullable|string|max:255',
        'chapter' => 'nullable|string|max:255',
        'page' => 'nullable|string|max:255',
        'coverphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'category' => 'nullable|string|max:255',
        'genre' => 'nullable|array',
        'genre.*' => 'nullable|string|max:255', 
        'author' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('coverphoto')) {
        $validatedData['coverphoto'] = $request->file('coverphoto')->store('coverphotos', 'public');
    }
    if (isset($validatedData['genre'])) {
        $validatedData['genre'] = implode(',', $validatedData['genre']);
    }

    ReadModel::create($validatedData);

    return redirect()->route('read')->with('success', 'Read added successfully!');
}


    // VIEW ALL
 public function read(Request $request)
{
    $CategoryModel = CategoryModel::all();
    $GenreModel = GenreModel::all();

    $query = ReadModel::query();

    // Apply search filters
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('category', 'like', '%' . $request->search . '%')
              ->orWhere('genre', 'like', '%' . $request->search . '%')
              ->orWhere('author', 'like', '%' . $request->search . '%')
              ->orWhere('status', 'like', '%' . $request->search . '%')
              ->orWhere('created_at', 'like', '%' . $request->search . '%')
              ->orWhere('updated_at', 'like', '%' . $request->search . '%');
        });
    }

    // Filter by exact category if selected
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Filter by all selected genres (must all exist in genre string)
    if ($request->filled('genre')) {
        $genres = is_array($request->genre) ? $request->genre : [$request->genre];

        foreach ($genres as $genre) {
            $query->where('genre', 'like', '%' . $genre . '%');
        }
    }

    if ($request->filled('letter')) {
    $query->where('title', 'like', $request->letter . '%');
}


    // Sort alphabetically by title
    $query->orderBy('title', 'asc');

    // Fetch the results
    $ReadModel = $query->get();

    // Return view with data
    return view('read', compact('ReadModel', 'CategoryModel', 'GenreModel'));
}




    // DELETE
    public function deletenote($id)
    {
        $ReadModel = ReadModel::findOrFail($id);

        // Optionally delete cover photo from storage
        if ($ReadModel->coverphoto && Storage::disk('public')->exists($ReadModel->coverphoto)) {
            Storage::disk('public')->delete($ReadModel->coverphoto);
        }

        $ReadModel->delete();

        return redirect()->back()->with('success', 'Note deleted successfully!');
    }

    // UPDATE
    public function updatenote(Request $request, $id)
    {
        $request->validate([
            'chapter' => 'required|string|max:255',
        ]);

        $read = ReadModel::find($id);

        if (!$read) {
            return redirect()->route('read')->with('error', 'Note not found.');
        }
        $read->chapter = $request->input('chapter');

        $read->save();

        return redirect()->route('read')->with('success', 'Note updated successfully.');
    }

    public function fullviewedit(Request $request)
{
    $CategoryModel = CategoryModel::all();
    $GenreModel = GenreModel::all();

    $note = ReadModel::findOrFail($request->id); // Load existing note

    return view('fullviewedit', [
        'CategoryModel' => $CategoryModel,
        'GenreModel' => $GenreModel,
        'note' => $note,
        'request' => $request,
    ]);
}



public function fulledit(Request $request)
{
    $categories = CategoryModel::all();
    $genres = GenreModel::all();

    $status = ['ongoing', 'archived', 'completed'];

    return view('fullviewedit', [
        'CategoryModel' => $categories,
        'GenreModel' => $genres,
        'status' => $status,
        'request' => $request,
    ]);
}


    // Update the note
  public function fullupdate(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'volume' => 'nullable|string|max:100',
        'chapter' => 'nullable|string|max:100',
        'page' => 'nullable|string|max:100',
        'author' => 'nullable|string|max:255',
        'category' => 'nullable|string',
        'genre' => 'nullable|array',
        'genre.*' => 'string',
        'status' => 'nullable|string',
        'coverphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    $note = ReadModel::findOrFail($id);

    // Update basic fields
    $note->title = $request->title;
    $note->volume = $request->volume;
    $note->chapter = $request->chapter;
    $note->page = $request->page;
    $note->author = $request->author;
    $note->category = $request->category;
    $note->status = $request->status;

    // Update genre
    $genreArray = $request->input('genre', []);
    $note->genre = implode(',', $genreArray);

    // Update cover photo
    if ($request->hasFile('coverphoto')) {
        // Delete old image if it exists
        if ($note->coverphoto && \Storage::exists($note->coverphoto)) {
            \Storage::delete($note->coverphoto);
        }

        // Store new file using same logic as storetoread()
        $note->coverphoto = $request->file('coverphoto')->store('coverphotos', 'public');
    }

    $note->save();

    return redirect()->route('read')->with('success', 'Note updated successfully.');
}


}


