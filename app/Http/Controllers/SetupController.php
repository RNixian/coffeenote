<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenreModel; 
use App\Models\CategoryModel; 

class SetupController extends Controller
{
    // ========================== VIEWS ==========================

    public function index(){
        return view('index');
    }
    
    public function sidebar()
    {
        return view('sidebar');
    }

    public function setup()
    {
        $CategoryModel = CategoryModel::paginate(8, ['*'], 'category_page');
        $GenreModel = GenreModel::paginate(8, ['*'], 'genre_page');

        
        return view('setup', compact('GenreModel', 'CategoryModel'));
    }

    // ========================== CATEGORY CUD ==========================

   public function storecategory(Request $request)
{
    $request->validate([
        'category' => 'required|min:1|max:255',
    ]);

    // Set last input in session (✅ DO NOT forget it here)
    session(['last_input' => 'category']);

    CategoryModel::create($request->only('category')); 

    return redirect()->route('setup');
}

    public function editcategory($id)
    {
        $category = CategoryModel::findOrFail($id);
        $GenreModel = GenreModel::all();
        $CategoryModel = CategoryModel::all();
        return view('setup', compact('category', 'GenreModel', 'CategoryModel'));
    }

    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|min:1|max:255',
        ]);

        $category = CategoryModel::findOrFail($id);
        $category->update($request->only('category'));

        return redirect()->route('setup');
    }

    public function deletecategory($id)
    {
        $category = CategoryModel::findOrFail($id);
        $category->delete(); 

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    // ========================== GENRE CUD ==========================

 public function storegenre(Request $request)
{
    $request->validate([
        'genre' => 'required|min:1|max:255',
    ]);

    session(['last_input' => 'genre']);

    GenreModel::create($request->only('genre'));

    return redirect()->route('setup');
}


    public function editgenre($id)
    {
        $genre = GenreModel::findOrFail($id);
        $GenreModel = GenreModel::all();
        $CategoryModel = CategoryModel::all();
        return view('setup', compact('genre', 'GenreModel', 'CategoryModel'));
    }

    public function updategenre(Request $request, $id)
    {
        $request->validate([
            'genre' => 'required|min:1|max:255',
        ]);

        $genre = GenreModel::findOrFail($id);
        $genre->update($request->only('genre'));

        return redirect()->route('setup');
    }

    public function deletegenre($id)
    {
        $genre = GenreModel::findOrFail($id);
        $genre->delete(); 

        return redirect()->back()->with('success', 'Genre deleted successfully!');
    }

    // ========================== SEARCH ==========================

    
}
