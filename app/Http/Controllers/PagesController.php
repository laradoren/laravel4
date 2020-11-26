<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Block;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.index')->with('pages', Page::all());
    }


    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $page = Page::create($request->except(['blocks']));

        if($request->has('blocks')) :
            $page->blocks()->attach($request->input('blocks'));
        endif;   

        return redirect()->route('admin.pages.index');
    }

   
    public function show(Request $request)
    {
        $url = $request->path();
        $page = Page::where('path', $url)->first();
        $pages = Page::orderBy('created_at', 'desc')->get();

        if ($page->alias_of ?? "" != 0){
            $newpage=Page::find($page->alias_of);
            $page->title = $newpage->title;
            $page->main_content = $newpage->main_content;
            $page->author = $newpage->author;
            $page->created_at = $newpage->created_at;
            $page->updated_at = $newpage->updated_at;            
        } 
        
        if ($page) {
            return view('home', ['page' => $page, 'blocks' => $blocks = Block::where('page_id', $page->id)->get(), 'alias' => Block::where('alias_id', $page->id)->sortable()->get()]);
        }     
        return view('sorry', ['pages' => $pages]);
    }


    public function edit(Page $page)
    {
        return view('admin.pages.edit')->with([
            'page' => $page,
        ]);
    }

    public function update(Request $request, Page $page)
    {      
        $page->update($request->except('blocks'));
        $page->blocks()->detach();
        if($request->has('blocks')) :
            $page->blocks()->attach($request->input('blocks'));
        endif;
        return redirect()->route('admin.pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index');
    }
}


