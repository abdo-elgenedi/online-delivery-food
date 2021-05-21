<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $states=State::all();
        return view('admin.states.index',compact(['states']));
    }

    public function create(){
        $cities=City::get();
        return view('admin.states.create',compact(['cities']));
    }
    public function store(Request $request){
        $validate=Validator::make($request->only('name','city_id'),['name'=>'string|max:30','city_id'=>'exists:cities,id'],['string'=>'the name must be string','max'=>'the name must be less than 30 chars','exists'=>'this city not found']);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        try {


            DB::beginTransaction();
            State::create([
                'name' =>$request->name,
                'city_id'=>$request->city_id
            ]);
            DB::commit();
            return redirect()->route('admin.states')->with(['success' => 'The State Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.states')->with(['success' => 'State Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id)
    {
        $state = State::find($id);
        $cities = City::all();
        if (!$state) {
            return redirect()->route('admin.states')->with(['success' => 'State Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
        return view('admin.states.update',compact(['state','cities']));
    }

    public function update(Request $request)
    {
        $validate=Validator::make($request->only('name','city_id'),['name'=>'string|max:30','city_id'=>'exists:cities,id'],['string'=>'the name must be string','max'=>'the name must be less than 30 chars','exists'=>'this city not found']);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $state = State::find($request->id);
        if (!$state) {
            return redirect()->route('admin.states')->with(['success' => 'State Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
        try {
            DB::beginTransaction();
            $state->update([
                'name' => $request->name,
                'city_id'=>$request->city_id
            ]);
            DB::commit();
            return redirect()->route('admin.states')->with(['success' => 'The State Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }
        catch
        (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.states')->with(['success' => 'The State Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function delete(Request $request)
    {
        try {
            $state = State::find($request->id);
            if (!$state) {
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'City Not Found',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke'
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'City Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $state->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The City Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The City Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }
}
