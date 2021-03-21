<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use Illuminate\Http\Request;

class PremiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $premise = Premise::create($data);

        return [
            'id'    => $premise->id,
            'name'  => $premise->name,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function show(Premise $premise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function edit(Premise $premise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Premise $premise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premise $premise)
    {
        //
    }
}
