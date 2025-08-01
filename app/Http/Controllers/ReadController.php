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
   $genreFromReadModel = ReadModel::pluck('genre')->toArray();

// Split comma-separated genres and collect unique values
$genres = collect($genreFromReadModel)
    ->flatMap(fn($item) => explode(',', $item))
    ->map(fn($g) => trim($g))
    ->unique()
    ->sort()
    ->values();


    // Include 'status' in the filter list for session tracking
    $filters = ['search', 'category', 'genre', 'letter', 'status'];

    // Store filters in session if present in request
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
    $status = $request->input('status', session('status'));

    // Start query builder
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

    if (!empty($status)) {
        $query->where('status', $status);
    }

    if (!empty($letter)) {
        $query->where('title', 'like', $letter . '%');
    }

    // Order by title, alphanumeric ignoring special chars
    $query->orderByRaw("REGEXP_REPLACE(title, '[^a-zA-Z0-9]', '') ASC");

    // Execute the query
    $ReadModel = $query->get();
    $totalnotes = $query->count();

    return view('read', compact(
    'ReadModel', 
    'CategoryModel', 
    'totalnotes'
))->with([
    'GenreModel' => $genres, // now contains only used genres
    'search' => $search,
    'categorySelected' => $category,
    'genreSelected' => $genre,
    'letterSelected' => $letter,
    'statusSelected' => $status,
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


  $ReadModelss = ReadModel::where('status', 'archived')
    ->orderBy('created_at', 'desc') // or any field you want to sort by
    ->take(7)
    ->get();


    $totalnotes = ReadModel::count();
    $totalongoing = ReadModel::where('status', 'ongoing')->count();
    $totalarchived = ReadModel::where('status', 'archived')->count();
    $totalcompleted = ReadModel::where('status', 'completed')->count();

    // Calculate chaptersum
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
    $chaptersum = $chaptersum - $totalnotes;

   $categoryCounts = ReadModel::select('category', \DB::raw('COUNT(*) as total'))
    ->whereNotNull('category')
    ->groupBy('category')
    ->orderByDesc('total')
    ->get();

    // ✅ Top 5 Genres (splitting comma-separated values)
    $allGenres = ReadModel::pluck('genre')->toArray();
    $genreCount = [];

    foreach ($allGenres as $genreString) {
        $genres = array_map('trim', explode(',', $genreString));
        foreach ($genres as $genre) {
            if (!empty($genre)) {
                $genreCount[$genre] = ($genreCount[$genre] ?? 0) + 1;
            }
        }
    }

    // Sort genres by count, get top 5
    arsort($genreCount);
    $topGenres = array_slice($genreCount, 0, 5, true); // [ 'action' => 10, 'romcom' => 9, ...]

    return view('dashboard', compact(
        'totalnotes',
        'totalarchived',
        'totalcompleted',
        'totalongoing',
        'ReadModel',
        'ReadModels',
        'chaptersum',
        'ReadModelss',
        'categoryCounts',
        'topGenres'
    ));
}



}