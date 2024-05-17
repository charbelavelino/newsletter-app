<?php

namespace App\Http\Controllers;

// use App\Models\NewsLetter;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\Success;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news-letter-view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     {
    //         $this->validate($request, [
    //             'email'=>'required|distinct'
    //         ]);
    //         $newsletter = new NewsLetter();
    //         $newsletter->email = $request->input('email');
    //         if ($newsletter->save())
    //         {
    //             Mail::send('emails.success', ['email' => $newsletter->email], function ($message)
    //             {
    //                 $message->from('cs@cdbpros.com', 'Goodness Kayode');
    //                 $message->to('cs@cdbpros.com');
    //             });
    //             return redirect()->back()->with('alert','You have successfully applied for our Newsletter');
    //         }else{
    //             return redirect()->back()->withErrors($validator);
    //         }
    //     }
    // }

    // public function autoMail(Request $request,$validator)
    // {
    //     $this->validate($request, [
    //         'email'=>'required|distinct'
    //     ]);
    //     $newsletter = new NewsLetter();
    //     $newsletter->email = $request->input('email');
    //      if ($newsletter->save())
    //     {
    //         Mail::to($newsletter->email)->send(new Success($newsletter));
    //         return redirect()->back()->with('alert','You have successfully applied for our Newsletter');
    //     }else{
    //         return redirect()->back()->withErrors($validator);
    //     }
    // }


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

    public function addSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();
            if($subscriberCount>0){
                echo "exists";
            }else{
                // Add Newsletter Email in newsletter_subscribers table
                $newsletter = new NewsletterSubscriber;
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                echo "saved";
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




