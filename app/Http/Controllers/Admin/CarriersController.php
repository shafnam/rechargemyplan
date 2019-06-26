<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Carrier;
use Illuminate\Support\Facades\Validator;

class CarriersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function carriersList($id =null){
        if($id){
            $all_carriers =  Carrier::all();
            $carrier = Carrier::where('id',$id)->first();
            return view('admin.carriers.carriers-list',compact('all_carriers','carrier'));
        }
        $all_carriers = Carrier::all();
        return view('admin.carriers.carriers-list',compact('all_carriers','carrier'));
    }

    public function carrierAdd(){
        return view('admin.carriers.carriers-add');
    }

    public function carrierSave(Request $request){
        
        $validator = Validator::make($request->all(),[
            'carrier_name' => 'string|required|regex:/^[a-zA-Z0-9 _-]+$/',
            'carrier_logo' => 'image|required|max:1999'
        ]);
        if($validator->fails()){
            return redirect(route('admin.carriers.add.get'))
                ->withErrors($validator)
                ->withInput();
        }       

        //Handle File Upload
        if($request->hasFile('carrier_logo')) {
            // Get File name with the extension
            $filenameWithExt = $request->file('carrier_logo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('carrier_logo')->getClientOriginalExtension();
            // Filename to store
            $file_name_to_store = $filename.'-'.time().'.'.$extension;
            // Path to store
            $path = public_path('images\carriers');
            // Upload Image
            $request->file('carrier_logo')->move($path, $file_name_to_store);
        } else {
            $file_name_to_store = 'noimage.jpg';
        }

        $carrier = new Carrier();
        $carrier->name = $request->get('carrier_name');
        $carrier->logo = $file_name_to_store;
        $carrier->description = $request->get('carrier_description');
        $carrier->status = '1';
        $carrier->plan_status = '0';
        $carrier->sim_status = '0';
        $carrier->save();

        return redirect(route('admin.carriers.add.get'))->with('success_messge',"Carrier Added successfully...");
    }

    public function carrierEdit($id,Request $request){
        $carrier = Carrier::where('id',$id)->first();
        if(!$carrier){
            return redirect(route('admin.carriers.list'));
        }
        return view('admin.carriers.carriers-edit',compact('carrier'));
    }

    public function carrierUpdate($id,Request $request){

        $validator = Validator::make($request->all(),[
            'carrier_name' => 'string|required|regex:/^[a-zA-Z0-9]+$/',
            'carrier_logo' => 'image|nullable|max:1999'
        ]);
        if($validator->fails()){
            return redirect(route('admin.carriers.edit.post',[$id]))
                ->withErrors($validator)
                ->withInput();
        }

        $carrier = Carrier::find($id);

        //If new image uploaded
        if($request->hasFile('carrier_logo')){
            /*ADD NEW IMAGE*/
            $filenameWithExt = $request->file('carrier_logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('carrier_logo')->getClientOriginalExtension();
            $file_name_to_store = $filename.'-'.time().'.'.$extension;
            $path = public_path('images\carriers');
            $request->file('carrier_logo')->move($path, $file_name_to_store);

            /*DELETE OLD IMAGE*/
            /*$old_image_name = Carrier::where('id', $id)->pluck('logo');
            Storage::delete($path. $old_image_name[0]);
            dd($path.$old_image_name[0]);*/
            $path = public_path('images\carriers\\').$carrier->logo;
            //dd($path);
            unlink($path);
        }
        else{
            $file_name_to_store = $carrier->logo;
        }

        $carrier->name = $request->get('carrier_name');
        $carrier->logo = $file_name_to_store;
        $carrier->description = $request->get('carrier_description');
        $carrier->status = $request->get('new_carrier_status');
        $carrier->plan_status = $request->get('new_plan_status');
        $carrier->sim_status = $request->get('new_sim_status');
        $carrier->save();

        return redirect(route('admin.carriers.edit.get',[$id]))->with('success_messge',"Carrier updated successfully...");
    }

    public function carrierDeactivate($id)
    {
        $carrier = Carrier::find($id);
        $carrier->status = '0';
        $carrier->save();

        return redirect(route('admin.carriers.list'))->with('success', 'Carrier Deactivated');
    }

    public function carrierActivate($id)
    {
        $carrier = Carrier::find($id);
        $carrier->status = '1';
        $carrier->save();

        return redirect(route('admin.carriers.list'))->with('success', 'Carrier Activated');
    }
}
