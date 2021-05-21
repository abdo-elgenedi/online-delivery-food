<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $users = User::get();
        return view('admin.users.index')->with([ 'users' => $users]);
    }

    public function delete(Request $request)
    {
        $id=$request->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'User Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            if($user->image!='customer.jpg'&&$user->image !=NULL){
                unlink(base_path('public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'customers'.DIRECTORY_SEPARATOR.$user->image));
            }
            $user->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The user Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The User Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);        }
    }

    public function changeStatus(Request $request){

        $id=$request->id;
        $user=User::find($id);
        if (!$user) {
            return response()->json([
                'show'=>true,
                'message' => 'User Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($user->status==0){$user->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The User Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Block',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($user->status==1){$user->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The User Blocked Successfully',
                    'bg' => 'bg-red',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Activate',
                    'btn'=>'primary',
                    'id'=>$request->id,
                    'status'=>'Blocked',
                    'statuscolor'=>'red'
                ]);}
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'message' => 'The User Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);        }
    }

    public function userDetails(Request $request){

        $id=$request->id;
        $user=User::find($id);
        if (!$user) {
            return response()->json([
                'show'=>true,
                'message' => 'User Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }else{
            return response()->json([
                'show'=>true,
                'cardname' => $user->name,
                'cardusername' => $user->username,
                'cardemail' => $user->email,
                'cardmobile' => $user->mobile,
                'cardstatus' => $this->detrmineStatus($user->status),
                'cardstatuscolor' => $this->detrmineStatusColor($user->status),
                'cardcreatedat' => $user->created_at->toFormattedDateString(),
                'cardcreatedfrom' => $user->created_at->diffForHumans(),
                'cardlogo' => $user->image

            ]);
        }
    }
    private function detrmineStatus($status){
        if($status==0){return 'Blocked';}
        elseif($status==1){return 'Active';}
    }
    private function detrmineStatusColor($status){
        if($status==0){return 'red';}
        elseif($status==1){return 'lightgreen';}
    }


}
