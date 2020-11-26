<?php

namespace App\Http\Controllers;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{

    public function index($page)
    {
        return view('admin.blocks.index', ['page' => $page, 'blocks' => Block::where('page_id', $page)->sortable()->get(), 'alias' => Block::where('alias_id', $page)->sortable()->get()]);  
    }

   

    public function create($page)
    {
        return view('admin.blocks.create', ['page' => $page]);
    }


    public function store(Request $request, $page)
    {
        Block::create($request->all());
        return redirect()->route('admin.blocks.index', $page );
    }
    
    public function show($page)
    {
        return view('admin.blocks.show', ['page' => $page, 'blocks' => Block::where('page_id', $page)->sortable()->get(), 'alias' => Block::where('alias_id', $page)->sortable()->get()]);  
    }


    public function edit(Block $block, $page)
    {
        return view('admin.blocks.edit')->with([
            'block' => $block,
            'page' => $page
        ]);
    }

    public function update(Request $request, Block $block, $page)
    {      
        $block->update($request->all());
        $block->save();
        return redirect()->route('admin.blocks.index',  $page);
    }

    public function destroy(Block $block, $page)
    {
        $block->delete();
        return redirect()->route('admin.blocks.index', $page);
    }
}




