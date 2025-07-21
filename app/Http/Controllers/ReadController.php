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
       $GenreModel = GenreModel::orderBy('genre', 'asc')->get();


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
        'coverphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
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
    $GenreModel = GenreModel::orderBy('genre', 'asc')->get();

    // Store filters in session if present in request
    $filters = ['search', 'category', 'genre', 'letter'];
    foreach ($filters as $filter) {
        if ($request->has($filter)) {
            session([$filter => $request->input($filter)]);
        } elseif (!session()->has($filter)) {
            session([$filter => null]); // ensure default null if not present
        }
    }

    // Retrieve filter values (from request or session fallback)
    $search = $request->input('search', session('search'));
    $category = $request->input('category', session('category'));
    $genre = $request->input('genre', session('genre'));
    $letter = $request->input('letter', session('letter'));

    $query = ReadModel::query();

    // Apply filters
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('category', 'like', '%' . $search . '%')
              ->orWhere('genre', 'like', '%' . $search . '%')
              ->orWhere('author', 'like', '%' . $search . '%')
              ->orWhere('status', 'like', '%' . $search . '%')
              ->orWhere('created_at', 'like', '%' . $search . '%')
              ->orWhere('updated_at', 'like', '%' . $search . '%');
        });
    }

    if (!empty($category)) {
        $query->where('category', $category);
    }

  if (!empty($genre)) {
    $genres = is_array($genre) ? $genre : [$genre];
    $query->where(function ($q) use ($genres) {
        foreach ($genres as $g) {
            $q->orWhere('genre', 'like', '%' . $g . '%');
        }
    });
}


    if (!empty($letter)) {
        $query->where('title', 'like', $letter . '%');
    }

    $query->orderByRaw("REGEXP_REPLACE(title, '[^a-zA-Z0-9]', '') ASC");
    $ReadModel = $query->get();
    $totalnotes = $query->count();
    return view('read', compact('ReadModel', 'CategoryModel', 'GenreModel', 'totalnotes'))
        ->with([
            'search' => $search,
            'categorySelected' => $category,
            'genreSelected' => $genre,
            'letterSelected' => $letter
        ]);
}




    // DELETE
    public function deletenote($id)
    {
        $ReadModel = ReadModel::findOrFail($id);

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
        'page' => 'nullable|string|max:255',
    ]);

    $read = ReadModel::find($id);

    if (!$read) {
        return redirect()->route('read')->with('error', 'Note not found.');
    }

    $read->chapter = $request->input('chapter');
    $read->page = $request->input('page');
    $read->save();

    return redirect()->route('read')->with('success', 'Note updated successfully.')->with('updated_id', $id);
}


    public function fullviewedit(Request $request)
{
    $CategoryModel = CategoryModel::all();
    $GenreModel = GenreModel::orderBy('genre', 'asc')->get();


    $note = ReadModel::findOrFail($request->id); 

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
        'coverphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
    ]);

    $note = ReadModel::findOrFail($id);


    $note->title = $request->title;
    $note->volume = $request->volume;
    $note->chapter = $request->chapter;
    $note->page = $request->page;
    $note->author = $request->author;
    $note->category = $request->category;
    $note->status = $request->status;

    
 if ($request->has('genre')) {
    $genreArray = $request->input('genre', []);
    $note->genre = implode(',', $genreArray);
}


   
    if ($request->hasFile('coverphoto')) {
        // Delete old image if it exists
        if ($note->coverphoto && \Storage::exists($note->coverphoto)) {
            \Storage::delete($note->coverphoto);
        }

        $note->coverphoto = $request->file('coverphoto')->store('coverphotos', 'public');
    }

    $note->save();
    return redirect()->route('read')
    ->with('success', 'Note updated successfully.')
    ->with('updated_id', $id);

}

public function dashread() {
    $ReadModel = ReadModel::orderBy('created_at', 'desc')->take(7)->get();
    $ReadModels = ReadModel::whereColumn('updated_at', '!=', 'created_at')
    ->orderBy('updated_at', 'desc')
    ->take(7)
    ->get();

    $ReadModelss = ReadModel::where('status', 'archived')->take(7)->get();
    $totalnotes = ReadModel::count();
    $totalongoing = ReadModel::where('status', 'ongoing')->count();
    $totalarchived = ReadModel::where('status', 'archived')->count();
    $totalcompleted = ReadModel::where('status', 'completed')->count();

    // Calculate the sum of whole number parts from the 'chapter' column
    $chapters = ReadModel::pluck('chapter');
    $chaptersum = 0;

    foreach ($chapters as $chapterString) {
        $chaptersArray = explode(',', $chapterString);

        foreach ($chaptersArray as $chapter) {
            if (preg_match('/\d+/', trim($chapter), $matches)) {
                $chaptersum += (int) $matches[0];
            }
        }
    }

    return view('dashboard', compact(
        'totalnotes',
        'totalarchived',
        'totalcompleted',
        'totalongoing',
        'ReadModel',
        'ReadModels',
        'chaptersum',
        'ReadModelss'
    ));
}


}