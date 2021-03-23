<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMap;
use Illuminate\Http\Request;

class AssetMapController extends Controller
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
    public function create(Asset $asset)
    {
        //dd($asset->map()->get()->isEmpty());
        if($asset->map()->get()->isEmpty()){
            return view('asset.map.create', compact('asset'));
        }else{
            return redirect()
                ->route('map.show',[$asset->id, $asset->map->id]);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Asset $asset)
    {
        $data = $request->except([
            '_token', 'address'
        ]);

        $data['asset_id'] = $asset->id;
        $assetMap = AssetMap::create($data);

        return redirect()
        ->route('map.show',[$asset->id, $assetMap->id])
        ->withSuccess('Asset Map has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetMap  $assetMap
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset, AssetMap $map)
    {
        return view('asset.map.show', compact('asset', 'map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetMap  $assetMap
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetMap $assetMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetMap  $assetMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetMap $assetMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetMap  $assetMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetMap $assetMap)
    {
        //
    }
}
