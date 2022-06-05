<?php

namespace App\Http\Controllers;

use App\Models\membership;
use App\Models\item;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class membersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = item::all();
        $members = membership::all();
        return view('members.add',compact('members','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $members = new membership();
        $members->gvBrowseCode = $request->input('gvBrowseCode');
        $members->gvBrowseCompanyName = $request->input('gvBrowseCompanyName');
        $members->gvBrowseAttention = $request->input('gvBrowseAttention');
        $members->gvBrowseUDF_TEMPATLAHIR = $request->input('gvBrowseUDF_TEMPATLAHIR');
        $members->gvBrowseUDF_ICNO = $request->input('gvBrowseUDF_ICNO');
        $members->gvBrowsePhone1 = $request->input('gvBrowsePhone1');
        $members->gvBrowseAddress1 = $request->input('gvBrowseAddress1');
        $members->gvBrowseArea = $request->input('gvBrowseArea');
        $members->gvBrowseUDF_DOB = $request->input('gvBrowseUDF_DOB');
        $members->gvBrowseUDF_NOAHLISKMC = $request->input('gvBrowseUDF_NOAHLISKMC ');
        $members->gvBrowseUDF_TARIKHMEMOHON = $request->input('gvBrowseUDF_TARIKHMEMOHON');
        $members->gvBrowseUDF_PEKERJAAN = $request->input('gvBrowseUDF_PEKERJAAN');
        $members->gvBrowseUDF_JANTINA = $request->input('gvBrowseUDF_JANTINA');
        $members->item_id = $request->input('item_id');
        $members->save();
        return redirect()->route('members.show')->with('success','New Member Added Successfully');
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
    public function edit($id)
    {
        $members = membership::find($id);
        $items = item::all();
        return view('members.edit',compact('members','items'));
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
        $members = membership::find($id);
        $members->gvBrowseCode = $request->input('gvBrowseCode');
        $members->gvBrowseCompanyName = $request->input('gvBrowseCompanyName');
        $members->gvBrowseAttention = $request->input('gvBrowseAttention');
        $members->gvBrowseUDF_TEMPATLAHIR = $request->input('gvBrowseUDF_TEMPATLAHIR');
        $members->gvBrowseUDF_ICNO = $request->input('gvBrowseUDF_ICNO');
        $members->gvBrowsePhone1 = $request->input('gvBrowsePhone1');
        $members->gvBrowseAddress1 = $request->input('gvBrowseAddress1');
        $members->gvBrowseArea = $request->input('gvBrowseArea');
        $members->gvBrowseUDF_DOB = $request->input('gvBrowseUDF_DOB');
        $members->gvBrowseUDF_NOAHLISKMC = $request->input('gvBrowseUDF_NOAHLISKMC ');
        $members->gvBrowseUDF_TARIKHMEMOHON = $request->input('gvBrowseUDF_TARIKHMEMOHON');
        $members->gvBrowseUDF_PEKERJAAN = $request->input('gvBrowseUDF_PEKERJAAN');
        $members->gvBrowseUDF_JANTINA = $request->input('gvBrowseUDF_JANTINA');
        $members->item_id = $request->input('item_id');
        $members->save();
        return redirect()->route('members.show')->with('success','Member Data Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = membership::find($id);
        $members->delete();
        return redirect()->route('members.show')->with('error','Member Deleted');
    }
}
