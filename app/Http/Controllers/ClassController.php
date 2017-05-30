<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use Exception;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $status = 'success';
            $data = ['data' => Classes::all(), 'status' => $status ];
        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
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
        try {
            $data = array('status' => 'success','message' => 'record was successfuly added');

            $validator = Validator::make($request->all(), Classes::getValidation());
            if ($validator->fails()) {
                $data['status'] = 'error';
                $data['message'] = $validator->messages();
                return response()->json($data);
            }
            Classes::create($request->all());

        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $record = Classes::findOrFail($id);
            $data = array('status' => 'success','data' => $record);
        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            $input = $request->all();
            $data = array('status' => 'success','message' => 'record was successfuly added');

            $validator = Validator::make($input, Classes::getValidation($id));
            if ($validator->fails()) {
                $data['status'] = 'error';
                $data['message'] = $validator->messages();
                return response()->json($data);
            }

            $record = Classes::findOrFail($id);
            $record->update($input);

        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $record = Classes::findOrFail($id);
            $record->delete();

            $data = array('status' => 'success','message' => 'record was successfuly deleted');
        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }
}
