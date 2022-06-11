<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\area;
use App\Models\membership;
use App\Models\item;
use Illuminate\Http\Request;

class membersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = area::orderBy('area_name')->get();
        $items = item::orderBy('year')->get();
        $members = membership::orderby('gvBrowseCompanyName')->get();
        $no_ahli_skmc = membership::max('gvBrowseUDF_NOAHLISKMC') + 1;
        return view('members.create', compact('members', 'items', 'no_ahli_skmc','areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $members = new membership();
        $code = $this->generate_code($request->input('gvBrowseCompanyName'));
        $members->gvBrowseCode = $code;
        $members->gvBrowseCompanyName = $request->input('gvBrowseCompanyName');
        $members->gvBrowseAttention = $request->input('gvBrowseAttention');
        $members->gvBrowseUDF_TEMPATLAHIR = $request->input('gvBrowseUDF_TEMPATLAHIR');
        $members->gvBrowseUDF_ICNO = $request->input('gvBrowseUDF_ICNO');
        $members->gvBrowsePhone1 = $request->input('gvBrowsePhone1');
        $members->gvBrowseAddress1 = $request->input('gvBrowseAddress1');
        $members->area_id = $request->input('area_id');
        $members->gvBrowseUDF_DOB = $request->input('gvBrowseUDF_DOB');
        $members->gvBrowseUDF_NOAHLISKMC = $request->input('gvBrowseUDF_NOAHLISKMC');
        $members->gvBrowseUDF_TARIKHMEMOHON = $request->input('gvBrowseUDF_TARIKHMEMOHON');
        $members->gvBrowseUDF_PEKERJAAN = $request->input('gvBrowseUDF_PEKERJAAN');
        $members->gvBrowseUDF_JANTINA = $request->input('gvBrowseUDF_JANTINA');
        $members->status = $request->input('status');
        $members->item_id = $request->input('item_id');
        $members->save();
        return redirect()->route('members.index')->with('success', __('messages.membership_created_successfully'));
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
        $areas = area::orderBy('area_name')->get();

        $members = membership::find($id);
        $items = item::all();
        return view('members.edit', compact('members', 'items','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembershipRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request, $id)
    {
        $members = membership::find($id);
        $members->gvBrowseCompanyName = $request->input('gvBrowseCompanyName');
        $members->gvBrowseAttention = $request->input('gvBrowseAttention');
        $members->gvBrowseUDF_TEMPATLAHIR = $request->input('gvBrowseUDF_TEMPATLAHIR');
        $members->gvBrowseUDF_ICNO = $request->input('gvBrowseUDF_ICNO');
        $members->gvBrowsePhone1 = $request->input('gvBrowsePhone1');
        $members->gvBrowseAddress1 = $request->input('gvBrowseAddress1');
        $members->area_id = $request->input('area_id');
        $members->gvBrowseUDF_DOB = $request->input('gvBrowseUDF_DOB');
        $members->gvBrowseUDF_TARIKHMEMOHON = $request->input('gvBrowseUDF_TARIKHMEMOHON');
        $members->gvBrowseUDF_PEKERJAAN = $request->input('gvBrowseUDF_PEKERJAAN');
        $members->gvBrowseUDF_JANTINA = $request->input('gvBrowseUDF_JANTINA');
        $members->status = $request->input('status');
        $members->item_id = $request->input('item_id');
        $members->save();
        return redirect()->route('members.index')->with('success', __('messages.membership_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $membership = membership::findOrFail($id);

        foreach ($membership->payments as $payment) {
            foreach ($payment->paymentDetails as $paymentDetail) {
                $paymentDetail->delete();
            }
            $payment->delete();
        }
        $membership->delete();

        return redirect()->route('members.index')->with('error', __('messages.membership_deleted_successfully'));
    }

    private function generate_code(string $name)
    {
        $result = membership::where('gvBrowseCode', 'LIKE', $name[0] . '%')->max('gvBrowseCode');
        if ($result == null) {
            return $name[0] . '0001';
        }


        $code_without_letter = substr($result, 1);
        $number = (int)$code_without_letter;
        $number++;
        $number = str_pad($number, 4, '0', STR_PAD_LEFT);
        $code = $name[0] . $number;
        return $code;
    }
}
