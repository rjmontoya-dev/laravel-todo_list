<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Item;
use Illuminate\Support\Carbon;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    { 
        $items = Item::orderBy('created_at', 'Desc')->get();
        return response($items);
        //  return response('Hello World', 200)
        //           ->header('Content-Type', 'text/plain');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $newItem = new Item();
        $newItem->name = $request->item['name'];
        $newItem->save();

         return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {   
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
       $existingItem =  Item::find($id); 
       if($existingItem){
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->update();
             return redirect()->back();
       }
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $existingItem = Item::find($id);

        if($existingItem){
            $existingItem->delete();
            return redirect()->back();
        }
         return redirect()->back();
    }
}
