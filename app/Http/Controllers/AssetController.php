<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAsset;
use App\Http\Requests\StoreAsset;
use App\Models\Asset;
use App\Models\Ministry;
use App\Models\Department;
use App\Models\Premise;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;  //change to this from Barryvdh\DomPDF\PDF
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        //dd(auth()->user()->role
        $user = Auth::user();
        //dd(Auth::user()->roles[0]->display_name); //dapatkan role
        //$role = Auth::user()->roles[0]->id;
        //$role = Auth::user()->roles();
        //dd(Auth::user()->hasPermission('create-asset')); //pa cache:clear
        //dd(Auth::user()->can('create-asset'));
        $data = array();
        $type = $request->type;

        $ministries = Ministry::byRole($user)->get(); //using local scope
        $data['ministries'] = $ministries;

        //https://laravel.com/docs/8.x/eloquent-relationships#eager-loading
        //with  if the user belongs to a team and has a team_id as a foreign key column, then $post->user->team is empty if you don't specifiy team_id
        $asset = Asset::with('ministry:id,name')->withSum('costs', 'sumber')->withCount('costs')
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($request->deadline, function ($query, $deadline) {
                $deadline = Carbon::createFromFormat('d/m/Y', $deadline)->format('Y-m-d');
                $query->where('deadline', $deadline);
            })
            ->when($request->ministry_id, function ($query, $ministry_id) {
                    $query->where('ministry_id', $ministry_id);
                // business logic
            })
            //to filter by ministry if role is KAD
            //hasRole('KAD') hasPermission('create-asset')
            ->when($user->hasRole('KAD'), function ($query, $ministry) {
                $ministry = Auth()->user()->ministry_id;
                $query->where('ministry_id', $ministry);
            })
            ->withTrashed()->sortable()->paginate(($type)?100000:5)->withQueryString();
        //dd($asset, $ministries); //accept multiple param
        $data['asset'] = $asset;
        $data['ministry'] = empty($request->ministry_id) ? '' : $request->ministry_id; 
        $data['deadline'] = empty($request->deadline) ? '' : $request->deadline; 
        $data['description'] = empty($request->description) ? '' : $request->description; 
        $data['pagination'] = $asset->isEmpty() ? 'Tiada rekod' : "Paparan ".$asset->firstItem()." hingga ".$asset->lastItem()." dari ".$asset->total();
        $data['type'] = $type;
        //dd($data);
        if($type =='excel'){
            return view('asset.export', $data);
        }elseif($type == 'word'){
            return view('asset.msword', $data);
        }elseif($type == 'pdf'){
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('asset.msword', $data)->setPaper('a4', 'landscape');
            return $pdf->download('Asset.pdf');
        }else{
            return view('asset.index', $data);
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * action / function
     */
    public function create()
    {

        //authorization using Gate

        abort_if(Gate::denies('asset:create'), 403);
        $user = Auth::user();
        //how to pass all col in table user
        //dd(auth()->user()->ministry_id);
        $ministries = Ministry::byRole($user)->get(); //using local scope
        $premises = Premise::all();

        $data = array();
        $data['ministries'] = $ministries;
        $data['premises'] = $premises;

        return view('asset.create', $data);
    }

    public function edit(Asset $asset)
    {

        if (!auth()->user()->hasPermission('edit-asset')) {
            return redirect()
            ->route('asset.index')
            ->withError('Invalid access');
        }
        
        $ministries = Ministry::all()->makeHidden('status');
        $premises = Premise::all();

        $data = array();
        $data['ministries'] = $ministries;
        $data['premises'] = $premises;
        $data['asset'] = $asset;

        return view('asset.edit', $data);
    }

    public function show(Asset $asset)
    {
        $user = Auth::user();

        //$asset::with('costs:sumber,tahun,asset_id')->get()->dd(); 
        //get relationship with certain colum, must include FK
        //$asset = $asset->load('asset_costs'); //lazy eager loading

        if($asset->trashed()){
            //dd('here');
            //Laravel dependency injection container will already fetch the data for you. But you have a deleted post. That's why you got a 404. So change your route to:

            //Route::get('posts/deleted/{id}/edit', 'PostController@edit');
            //And your controller to
            
            // public function edit($id)
            // {
            //     $posts = Post::withTrashed()->find($id);
            //     return view('post.edit', compact('posts'));
            // }
        }
        $data = array();
        $data['asset'] = $asset->load('maps');
        //dd($asset->map->lat);
        return view('asset.show', $data);
    }

    public function deleteall(Request $request)
    {
        $ids = explode('/',$request->getRequestUri());
        DB::table("assets")->whereIn('id',explode(",",$ids[3]))->delete();
        return redirect()->route('asset.index')->withSuccess('Assets Deleted successfully');
    }
    
    public function approveall(Request $request)
    {
        $ids = explode('/',$request->getRequestUri());
        DB::table("assets")->whereIn('id',explode(",",$ids[3]))->update([ 'status' => 3]);
        return redirect()->route('asset.index')->withSuccess('Assets Approval is successful-ling');
    }

    public function destroy(Asset $asset)
    {

        $asset->delete(); //totaldestroy
        //$asset->update(['deleted_at' => date('Y-m-d H:i:s')]); //using softdelete
        
        return redirect()
        ->route('asset.index')
        ->withSuccess('Asset has been deleted.');
    }
    
   
    
    public function store(CreateAsset $request)
    {

        $data = $request->except([
            '_token','checkKnowledge'
        ]);

        //$request->has('checkKnowledge'); for checkbox input
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
        //$path = $request->file('avatar')->storeAs('avatars',$fileNameToStore);
        //Storage::disk('public')->put('uploads/' . $fileNameToStore, 'Conten');

        $request->attachment->move(public_path('storage/uploads'), $fileNameToStore);
        
        $data['attachment'] = $fileNameToStore;
        $asset = Asset::create($data);
        //$id generate next auto increment table Asset lastInsertedId()
        return redirect()
        ->route('asset.show',$asset->id)
        ->withSuccess('Asset has been added successfully.');
    }
    public function update(StoreAsset $request, Asset $asset)
    {
        $data = $request->except([
            '_token'
        ]);

        if ($request->hasFile('attachment')) {
            $filenameWithExt = $request->file('attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->attachment->move(public_path('storage/uploads'), $fileNameToStore);

            $data['attachment'] = $fileNameToStore;
        }

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
