<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Mail\AcceptedVendorMail;
use App\Mail\BlockedVendorMail;
use App\Models\Admin;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    use Notifiable;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $vendors = Vendor::selection()->notPending()->get();
        return view('admin.vendors.index')->with(['vendors' => $vendors]);
    }

    public function pending()
    {
        $vendors = Vendor::selection()->pending()->get();
        return view('admin.vendors.pending')->with(['vendors' => $vendors]);
    }


    public function edit($id)
    {
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return redirect()->route('admin.vendors')->with(['success' => 'Vendor Not Found Please Select From The Table Only', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
        return view('admin.vendors.update')->with(['vendor' => $vendor,]);
    }

    public function update(VendorRequest $request)
    {
        $id=$request->id;
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return redirect()->route('admin.vendors')->with(['success' => 'Vendor Not Found Please Select From The Table Only', 'bg' => 'bg-cyan', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
        try {
            DB::beginTransaction();
            $vendor->update([
                'name' =>$request['name'],
                'username' =>$request['username'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'address' => $request['address'],
                'ssn' => $request['ssn'],
                'status' => $vendor->status,
                'logo' => $vendor->logo,
            ]);

            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'The Vendor Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }
        catch
        (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.vendors')->with(['success' => 'The Vendor Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }

    }


    public function delete(Request $request)
    {
        $id=$request->id;
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Vendor Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            if($vendor->logo!='vendor.jpg'&&$vendor->logo !=NULL){
                unlink(base_path('public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'vendors'.DIRECTORY_SEPARATOR.$vendor->logo));
            }
          $vendor->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Vendor Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Vendor Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);        }
    }
    public function pendingAction(Request $request){

        $id=$request->id;
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Vendor Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            DB::beginTransaction();
            $mailData=[
                'name'=>$vendor->name,
                'created_at'=>$vendor->created_at->toFormattedDateString(),
            ];
            if($request->action=='accept'){
                $vendor->update(['status'=>1]);
                Mail::to($vendor->email)->send(new AcceptedVendorMail($mailData));
                DB::commit();
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'The Vendor Accepted Successfully',
                    'bg' => 'bg-green',
                    'color' => 'whitesmoke',
                    'deleted'=>true
                ]);} elseif($request->action=='block'){
                $vendor->update(['status'=>0]);
                Mail::to($vendor->email)->send(new BlockedVendorMail($mailData));
                DB::commit();
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'The Vendor Blocked Successfully',
                    'bg' => 'bg-red',
                    'color' => 'whitesmoke',
                    'deleted'=>true
                ]);}else{
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'The Action Does Not Clear',
                    'bg' => 'bg-red',
                    'color' => 'whitesmoke']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'show'=>true,
                'message' => 'The Vendor Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $vendor=Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                'show'=>true,
                'message' => 'Vendor Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($vendor->status==0){$vendor->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Vendor Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Block',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($vendor->status==1||$vendor->status==2){$vendor->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Vendor Blocked Successfully',
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
                'message' => 'The Vendor Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);        }
    }

    public function vendorDetails(Request $request){

        $id=$request->id;
        $vendor=Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                'show'=>true,
                'message' => 'Vendor Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }else{
            return response()->json([
                'show'=>true,
                'cardname' => $vendor->name,
                'cardusername' => $vendor->username,
                'cardemail' => $vendor->email,
                'cardmobile' => $vendor->mobile,
                'cardaddress' => $vendor->address,
                'cardssn' => $vendor->ssn,
                'cardstatus' => $this->detrmineStatus($vendor->status),
                'cardstatuscolor' => $this->detrmineStatusColor($vendor->status),
                'cardcreatedat' => $vendor->created_at->toFormattedDateString(),
                'cardcreatedfrom' => $vendor->created_at->diffForHumans(),
                'cardlogo' => $vendor->logo

            ]);
        }
    }
    private function detrmineStatus($status){
        if($status==-1){return 'Pending';}
        elseif($status==0){return 'Blocked';}
        elseif($status==1){return 'Active';}
        elseif($status==2){return 'Deactive';}
    }
    private function detrmineStatusColor($status){
        if($status==-1){return 'yellow';}
        elseif($status==0){return 'red';}
        elseif($status==1){return 'lightgreen';}
        elseif($status==2){return 'lightred';}
    }
}