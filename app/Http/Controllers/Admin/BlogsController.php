<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Blog;
//use App\Carrier;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function blogsList($id =null){
        if($id){
            
            /*$active_carrier_ids = Carrier::where('status', 1)->pluck('id')->all();
            $all_plans = Plan::whereIn('carrier_id', $active_carrier_ids)->get();
            $plan = Plan::where('id',$id)->first();
            return view('admin.plans.plans-list',compact('all_plans','plan'));*/
        }
        $all_blogs = Blog::where('status',1)->get();
        return view('admin.blogs.blogs-list',compact('all_blogs'));
    }

    public function blogView($id){
        $blog = Blog::where('id', $id)->first();
        return view('admin.blogs.blogs-view',compact('blog'));
    }

    public function blogAdd(){
        //$all_blogs = Blog::where('status',1)->get();
        return view('admin.blogs.blogs-add');
    }

    public function blogSave(Request $request){

        /*$this->validate($request, [

            'blog_content' => 'required',

        ]);*/

        $validator = Validator::make($request->all(),[
            'blog_name' => 'required',
            'blog_content' => 'required',
            'blog_featured_image' => 'image|required|max:1999'
        ]);

        if($validator->fails()){
            return redirect(route('admin.blogs.add.get'))
                ->withErrors($validator)
                ->withInput();
        }

        //Handle File Upload (Featured Image)
        if($request->hasFile('blog_featured_image')) {
            // Get File name with the extension
            $filenameWithExt = $request->file('blog_featured_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('blog_featured_image')->getClientOriginalExtension();
            // Filename to store
            $file_name_to_store = $filename.'-'.time().'.'.$extension;
            // Path to store
            $path = public_path('images\blogs');
            // Upload Image
            $request->file('blog_featured_image')->move($path, $file_name_to_store);
        } else {
            $file_name_to_store = 'noimage.jpg';
        }

        $detail=$request->input('blog_content');

        $dom = new \DomDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= "/images/blogs/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $detail = $dom->saveHTML();

        //dd($detail);

        $blog = new Blog;
        $blog->name = $request->get('blog_name');
        $blog->featured_image = $file_name_to_store;
        $blog->content = $detail;
        $blog->author = 'Admin';
        $blog->save();
        return redirect(route('admin.blogs.add.get'))->with('success_messge',"Blog Added successfully...");
    }

    public function planEdit($id,Request $request){
        $plan = Plan::where('id',$id)->first();
        $all_carriers = Carrier::where('status',1)->get();
        if(!$plan){
            return redirect(route('admin.plans.list'));
        }
        return view('admin.plans.plans-edit',compact('plan','all_carriers'));
    }

    public function planUpdate($id,Request $request){

        $validator = Validator::make($request->all(),[
            'carrier' => 'required',
            'plan_name' => 'required',
            'plan_description' => 'required',
            'plan_price' => 'required',
            'plan_discount_percentage' => 'required_if:new_plan_discont,==,1',
            'plan_logo' => 'image|nullable|max:1999'
        ]);
        if($validator->fails()){
            return redirect(route('admin.plans.edit.post',[$id]))
                ->withErrors($validator)
                ->withInput();
        }

        $plan = Plan::find($id);

        //If new image uploaded
        if($request->hasFile('plan_logo')){
            /*ADD NEW IMAGE*/
            $filenameWithExt = $request->file('plan_logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('plan_logo')->getClientOriginalExtension();
            $file_name_to_store = $filename.'-'.time().'.'.$extension;
            $path = public_path('images\plans');
            $request->file('plan_logo')->move($path, $file_name_to_store);

            /*DELETE OLD IMAGE*/
            /*dd($path.$old_image_name[0]);*/
            $path = public_path('images\plans\\').$plan->logo;
            //dd($path);
            unlink($path);
        }else{
            $file_name_to_store = $plan->logo;
        }

        $plan->carrier_id = $request->get('carrier');
        $plan->name = $request->get('plan_name');
        $plan->logo = $file_name_to_store;
        $plan->description = $request->get('plan_description');
        $plan->price = $request->get('plan_price');
        $plan->discount_check = $request->get('new_plan_discont');
        if($request->get('most_popular_plan')){
            $plan->goto_special_segment = '1';
        }else{
            $plan->goto_special_segment = '0';
        }
        $plan->status = $request->get('new_plan_status');
        $plan->discount_percentage = $request->get('plan_discount_percentage');       
        $plan->sim_discount_percentage = $request->get('sim_discount_percentage');
        $plan->save();

        return redirect(route('admin.plans.edit.get',[$id]))->with('success_messge',"Plan updated successfully...");
    }

    public function planDeactivate($id)
    {
        $plan = Plan::find($id);
        $plan->status = '0';
        $plan->save();

        return redirect(route('admin.plans.list'))->with('success', 'Plan Deactivated');
    }

    public function planActivate($id)
    {
        $plan = Plan::find($id);
        $plan->status = '1';
        $plan->save();

        return redirect(route('admin.plans.list'))->with('success', 'Plan Activated');
    }
}
