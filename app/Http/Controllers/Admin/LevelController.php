<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        $page = 'level';
        $levels = DB::table('level')
            ->get();
        return view('admin.level-index', compact('page', 'levels'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('level')->where('id', '=', $id)->delete();
        return redirect()->route('admin.level.index')->withSuccess(trans('content.level_delete_successfull'));
    }

    /**
     * Test si la question est utilisée dans un QCM
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function testLevel(Request $request, $id) {
        if ($request->ajax()) {
            $question = DB::table('question')
                ->where('level_id', '=', $id)
                ->get();
            if (empty($question)) {
                $reponse = array(
                    'success' => true,
                    'data' => true,
                    'msg' => trans('content.level_index_delete_good')
                );
            } else {
                $reponse = array(
                    'success' => true,
                    'data' => false,
                    'msg' => trans('content.level_index_delete_bad')
                );
            }
            return json_encode($reponse);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $page     = 'level';
        $level = new Level();

        return view('admin.level-create-update', compact('page', 'level'));
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
                ->route('admin.level.create')
                ->withErrors($validator)
                ->withInput();
        }

        $level = new Level();

        $level->label = $request->label;
        $level->point = $request->point;
        $level->save();

        return redirect()
            ->route('admin.level.index')
            ->withSuccess(trans('content.level_index_store_successfull'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function checkValidator($request) {
        $label = trans('content.level_add_placeholder_name');
        $point = trans('content.level_add_label_point');

        $validator = Validator::make(
            [
                $label => $request->input('label'),
                $point => $request->input('point'),
            ],
            [
                $label => 'required',
                $point => 'required',
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
        $page     = 'level';
        $level = Level::findOrFail($id);

        return view('admin.level-create-update', compact('page', 'level'));
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
        $page     = 'level';
        $level = Level::findOrFail($id);

        $validator = $this->checkValidator($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        };

        $level->label = $request->label;
        $level->point = $request->point;
        $level->save();

        return redirect()
            ->route('admin.level.index')
            ->withSuccess(trans('content.level_update_successfull'));
    }
}