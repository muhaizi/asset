<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAsset;
use App\Models\Asset;
use App\Models\Ministry;
use App\Models\Department;
use App\Models\Premise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(auth()->user()->role);
        $user = Auth::user();
        //$role = Auth::user()->roles[0]->id;
        //$role = Auth::user()->roles();
        //dd(Auth::user()->hasPermission('create-asset')); //pa cache:clear
        //dd(Auth::user()->can('create-asset'));
        $data = array();

        $ministries = Ministry::all();
        $data['ministries'] = $ministries;

        $asset = Asset::with('ministry')
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($request->deadline, function ($query, $deadline) {
                $deadline =  Carbon::createFromFormat('d/m/Y', $deadline)->format('Y-m-d');
                $query->where('deadline', $deadline);
            })
            ->when($request->ministry_id, function ($query, $ministry_id) {
                $query->where('ministry_id', $ministry_id);
            })
            ->paginate(3)->withQueryString();

        $data['asset'] = $asset;
        $data['ministry'] = empty($request->ministry_id) ? '' : $request->ministry_id; 
        $data['deadline'] = empty($request->deadline) ? '' : $request->deadline; 
        $data['pagination'] = $asset->isEmpty() ? 'Tiada rekod' : "Paparan ".$asset->firstItem()." hingga ".$asset->lastItem()." dari ".$asset->total();
        return view('asset.index', $data);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * action / function
     */
    public function create()
    {
        $ministries = Ministry::all();
        $premises = Premise::all();

        $data = array();
        $data['ministries'] = $ministries;
        $data['premises'] = $premises;

        return view('asset.create', $data);
    }

    public function edit(Asset $asset)
    {
        $ministries = Ministry::all();
        $premises = Premise::all();

        $data = array();
        $data['ministries'] = $ministries;
        $data['premises'] = $premises;
        $data['asset'] = $asset;

        return view('asset.edit', $data);
    }

    public function show(Asset $asset)
    {
        //$contents = Storage::get('public/uploads/'.$asset->attachment);
        $data = array();
        $data['asset'] = $asset;
        return view('asset.show', $data);
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()
                ->route('asset.index')
                ->withSuccess('Asset has been deleted.');
    }
    
    public function store(CreateAsset $request)
    {
        $data = $request->except([
            '_token'
        ]);

        //$fileName = time().'.'.$request->attachment->extension();  

        // Get filename with the extension
        $filenameWithExt = $request->file('attachment')->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('attachment')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        //$path = $request->file('avatar')->storeAs('public/avatars',$fileNameToStore);
        //Storage::disk('public')->put('uploads/' . $fileNameToStore, 'Conten');

        $request->attachment->move(public_path('storage/uploads'), $fileNameToStore);
        
        $data['attachment'] = $fileNameToStore;
        $asset = Asset::create($data);

        return redirect()
        ->route('asset.show',$asset->id)
        ->withSuccess('Asset has been added successfully.');
    }
    public function update(Request $request, Asset $asset)
    {
        $data = $request->except([
            '_token', 'attachment'
        ]);

        $asset->update($data);

        return redirect()
        ->route('asset.show',$asset->id)
        ->withSuccess('Asset has been modified successfully.');
    }

    public function getDepartment($id){

        $department = Department::parentCode($id);
        
        return is_null($department)
            ? ['Department not-found']
            : $department->pluck('id','name');
    }
}
