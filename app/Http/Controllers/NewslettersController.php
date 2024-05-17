<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;

class NewslettersController extends Controller
{
    public function addSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();

            if($subscriberCount>0){
                return "exists";
            }else{
                $newsletter = new NewsletterSubscriber;
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                return "inserted";
            }
        }
    }


    public function checkSubscriber(Request $request){
    	if($request->ajax()){
    		$data = $request->all();
    		/*echo "<pre>"; print_r($data); die;*/
    		$subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();
    		if($subscriberCount>0){
    			echo "exists";
    		}
    	}
    }

    public function viewNewsletterSubscribers(){
        $newsletters = NewsletterSubscriber::get();
        return view('admin.newsletters.view_newsletters')->with(compact('newsletters'));
    }

    public function updateNewsletterStatus($id,$status){
        NewsletterSubscriber::where('id',$id)->update(['status'=>$status]);
        return redirect()->back()->with('flash_message_success','Newsletter Status has been updated!');
    }

    public function deleteNewsletterEmail($id){
        NewsletterSubscriber::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Newsletter Email has been deleted!');
    }
}
