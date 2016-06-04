<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 04/06/2016
 * Time: 20:06
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use App\Models\Rh;

class RhController extends Controller
{
    public function index() {
        $page = 'rh';
        $rhs = DB::table('rh')
            ->get();

        return view('admin.rh', compact('page', 'rhs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $page     = 'rh';
        $rh = new Rh();

        return view('admin.rh-create-update', compact('page', 'rh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->checkValidator($request);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.rh.create')
                ->withErrors($validator)
                ->withInput();
        }

        $rh = new Rh();

        $rh->lastname = $request->lastname;
        $rh->firstname = $request->firstname;
        $rh->email = $request->email;
        $rh->save();

        return redirect()
            ->route('admin.rh.index')
            ->withSuccess(trans('content.rh_index_store_successfull'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function checkValidator($request) {
        $lastname = trans('content.rh_add_label_lastname');
        $firstname = trans('content.rh_add_label_firstname');
        $email = trans('content.rh_add_label_mail');

        $validator = Validator::make(
            [
                $lastname => $request->input('lastname'),
                $firstname => $request->input('firstname'),
                $email => $request->input('email'),
            ],
            [
                $lastname => 'required',
                $firstname => 'required',
                $email => 'required|email',
            ]);

        return $validator;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page     = 'rh';
        $rh = Rh::findOrFail($id);

        return view('admin.rh-create-update', compact('page', 'rh'));
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
        $page     = 'rh';
        $rh = Rh::findOrFail($id);

        $validator = $this->checkValidator($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        };

        $rh->lastname = $request->lastname;
        $rh->firstname = $request->firstname;
        $rh->email = $request->email;
        $rh->save();

        return redirect()
            ->route('admin.rh.index')
            ->withSuccess(trans('content.rh_update_successfull'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('rh')->where('id', '=', $id)->delete();
        return redirect()->route('admin.rh.index')->withSuccess(trans('content.rh_delete_successfull'));
    }

    /**
     * Test si la question est utilisée dans un QCM
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function testRh(Request $request, $id) {
        if ($request->ajax()) {
            $question = DB::table('rh')
                ->where('lastname', '=', $id)
                ->get();
            if (empty($question)) {
                $reponse = array(
                    'success' => true,
                    'data' => true,
                    'msg' => trans('content.rh_index_delete_good')
                );
            } else {
                $reponse = array(
                    'success' => true,
                    'data' => false,
                    'msg' => trans('content.rh_index_delete_bad')
                );
            }
            return json_encode($reponse);
        }
    }
}