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
        'genre' => 'nullable|array', // 👈 validate as array
        'genre.*' => 'nullable|string|max:255', // 👈 each value in array
        'author' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('coverphoto')) {
        $validatedData['coverphoto'] = $request->file('coverphoto')->store('coverphotos', 'public');
    }

    // Convert genre array to comma-separated string before saving
    if (isset($validatedData['genre'])) {
        $validatedData['genre'] = implode(', ', $validatedData['genre']);
    }

    ReadModel::create($validatedData);

    return redirect()->route('read')->with('success', 'Read added successfully!');
}


    // VIEW ALL
 public function read(Request $request)
{
    $CategoryModel = CategoryModel::all();
    $GenreModel = GenreModel::all();

    // Start building query
    $query = ReadModel::query();

    // Apply search filters
    if ($request->has('search') && $request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('volume', 'like', '%' . $request->search . '%')
              ->orWhere('chapter', 'like', '%' . $request->search . '%')
              ->orWhere('page', 'like', '%' . $request->search . '%')
              ->orWhere('category', 'like', '%' . $request->search . '%')
              ->orWhere('genre', 'like', '%' . $request->search . '%')
              ->orWhere('author', 'like', '%' . $request->search . '%')
              ->orWhere('status', 'like', '%' . $request->search . '%')
              ->orWhere('created_at', 'like', '%' . $request->search . '%')
              ->orWhere('updated_at', 'like', '%' . $request->search . '%');
        });
    }

    // Optional filters for category and genre
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('genre')) {
        $query->where('genre', $request->genre);
    }

    // Sorting
    $query->orderBy('title', 'asc');

    // Execute the query
    $ReadModel = $query->get();

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
            'title' => 'required|string|max:255',
            'chapter' => 'required|string|max:255',
            'coverphoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $read = ReadModel::find($id);

        if (!$read) {
            return redirect()->route('read')->with('error', 'Note not found.');
        }

        $read->title = $request->input('title');
        $read->chapter = $request->input('chapter');

        if ($request->hasFile('coverphoto')) {
            if ($read->coverphoto && Storage::disk('public')->exists($read->coverphoto)) {
                Storage::disk('public')->delete($read->coverphoto);
            }

            $read->coverphoto = $request->file('coverphoto')->store('coverphotos', 'public');
        }

        $read->save();

        return redirect()->route('read')->with('success', 'Note updated successfully.');
    }
}
