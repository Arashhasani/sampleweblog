<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::query()->paginate(10);
        return view('welcome',compact('articles'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validdata=$request->validate([
            'title'=>['required'],
            'text'=>['required'],
            'pic'=>['required','max:8192','mimes:png,jpg'],
            'video'=>['required','max:200000'],
            'category'=>['required'],
        ]);

        $icon=$request->file('pic');
        $destination='img'.'/'.now()->year.'/'.now()->month.'/'.now()->day.'/';
        $iconname=Str::random(16);
        $icon->move(public_path($destination),$iconname.'.'.$icon->getClientOriginalExtension());
        $validdata['pic']='/'.$destination.$iconname.'.'.$icon->getClientOriginalExtension();

        $icon=$request->file('video');
        $destination='video'.'/'.now()->year.'/'.now()->month.'/'.now()->day.'/';
        $iconname=Str::random(16);
        $icon->move(public_path($destination),$iconname.'.'.$icon->getClientOriginalExtension());
        $validdata['video']='/'.$destination.$iconname.'.'.$icon->getClientOriginalExtension();

        $article=Article::create($validdata);

        $article->categories()->sync($request['category']);
        return redirect(route('articles.index'));



        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json($request->all());
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function statusUpdate(Request $request)
    {
        if ($request->has('id')){
            $article=Article::query()->where('id',$request['id'])->firstOrFail();
            if ($article['status']=='saved'){
                $article->update([
                    'status'=>'published'
                ]);
                return response()->json(['status'=>1,'text'=>'saved','finalstatus'=>'published']);


            }elseif ($article['status']=='published'){
                $article->update([
                    'status'=>'saved'
                ]);
                return response()->json(['status'=>1,'text'=>'published','finalstatus'=>'saved']);

            }

        }
        return response()->json(['status'=>0]);



    }
}
