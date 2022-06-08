<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;

class   itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'amount' => 'required',
        ]);
        $items = new item();
        $items->title = $request->input('title');
        $items->year = $request->input('year');
        $items->amount = $request->input('amount');
        $items->save();
        return redirect()->route('items.index')->with('success', 'New Item Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
        $item = item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'amount' => 'required',
        ]);

        $items = item::findOrFail($id);
        $items->title = $request->input('title');
        $items->year = $request->input('year');
        $items->amount = $request->input('amount');
        $items->save();
        return redirect()->route('items.index')->with('success', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = item::findOrFail($id);
        $items->delete();
        return redirect()->back()->with('error', 'Item Deleted');
    }
}
