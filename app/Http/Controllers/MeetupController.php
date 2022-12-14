<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;

class MeetupController extends Controller
{
    //

    public function create(Request $request){
        $postid = $request->id_post;
        if($postid){

            $posts = Post::whereId($postid)->where('status', null)->first();

            if($posts){

                if(!$posts->checkUserAuthPost()){

                    // dd($posts->user_id);
                    if($posts->CheckUserBlock()){
                          return redirect()->route('home');
                    }
                    return view('meetup.create', compact('postid'));

                }else{
                    
                    return redirect('/posts');
                }

            }
            else{

                return redirect('/posts');
            }

        }else{

            return redirect('/posts');
        }

    }
    // public function store(Request $request){

    //     $meetup = new Meetup;

    //     $data = Validator::make($request->all(),
    //         [
    //             'meetup_date' => 'required|date',
    //             'post_id' => 'required',
    //             'remarks' => 'required'
    //         ]
    //     );

    //     if($data->fails()){

    //         return response()->json(
    //             [
    //                  'status'=>400,
    //                  'messages'=>$data->getMessageBag(),
    //             ]
    //         );

    //     }else{

    //         $posts = Post::whereId($request->input('post_id'))->first();

    //         $request['requestor_id'] = auth()->user()->id;
    //         $request['approver_id'] = $posts->user_id;

    //         if($posts){

    //             //check if user have already meetup

    //             $check = $meetup->whereRequestorId($request['requestor_id'])->whereApproverId($request['approver_id'])->wherePostId($request->input('post_id'))->first();



    //            if($check){
    //                 return response()->json(
    //                     [
    //                         'status'=>404,
    //                         'messages'=>'You Already Set Meeting Up On this Post'
    //                     ]
    //                 );
    //            }else{


    //                  $meetup->create($request->all());

    //                  Notification::create([
    //                     'user_id' => $request['approver_id'],
    //                     'remarks' => auth()->user()->name. ' sent a meetup request to you.',
    //                     'redirect_link' => route('meetup.showrequestmeetuplist'),
    //                 ]);

    //                  return response()->json(
    //                     [
    //                         'status'=>204,
    //                         'messages'=>'success'
    //                     ]
    //                 );

    //            }


    //         }else{
    //             return response()->json(
    //                 [
    //                      'status'=>404,
    //                      'messages'=>'Post Not Found'
    //                 ]
    //             );
    //         }

    //     }
    // }
    public function showrequestmeetuplist(Request $request){
        $meetup = new Meetup;
        $approver_id = auth()->user()->id;
        $meet = $meetup->whereApproverId($approver_id)->get();
        $meetupid = [];
        foreach($meet as $item){
            if(!$item->CheckUserBlock()){
                    $meetupid[] = $item->id;
            }
        }
        $meetdata = $meetupid;
        $meetupdata = $meetup->whereApproverId($approver_id)->whereIn('id', $meetdata)->latest()->take(25)->paginate(15);
        return view('meetup.request_meetup' ,compact('meetupdata'));

        // $meetupdata = $meetup->whereApproverId($approver_id)->whereRequestorId($reqid[])->latest()->take(25)->paginate(5);

        // $meetupdata = $meetup->whereApproverId($approver_id)->latest()->take(25)->paginate(15);
        // return view('meetup.request_meetup' ,compact('meetupdata'));

    }
    public function showrequestedmeetuplist(Request $request){
        $meetup = new Meetup;
        $authid = auth()->user()->id;
        $meet = $meetup->whereRequestorId($authid)->get();
        $meetupid = [];
        foreach($meet as $item){
            if(!$item->CheckUserBlock()){
                $meetupid[] =  $item->id;
            }
        }
        $meetdata = $meetupid;
        $meetupdata = $meetup->whereRequestorId($authid)->whereIn('id', $meetdata)->latest()->take(25)->paginate(5);
        // dd($meetupdata);
        return view('meetup.requested_meetup' ,compact('meetupdata'));

    }
    public function processmeetupview(Request $request){

        $meetup = new Meetup;

        $approver_id = auth()->user()->id;

        $meetupdata = $meetup->whereApproverId($approver_id)->whereId($request->meetup_id)->first();
        if($meetupdata->approved_at || $meetupdata->declined_at){
            abort(404);
        }else{
            if($meetupdata){

                if($meetupdata->CheckUserBlock()){
                   abort(404);
                }
                $posts = Post::whereId($meetupdata->post_id)->where('status', null)->first();
                if($posts){
                    return view('meetup.process', compact('meetupdata'));
                }else{
                    abort(404);
                }
    
            }else{
    
                abort(404);
            }
        }
        
    }
    public function processmeetup(Request $request){

        $meetup = new Meetup;

        $approver_id = auth()->user()->id;

        $data = Validator::make($request->all(),
            [
                'meetup_id' => 'required',
                'process' => 'required',
            ]
        );
        if($data->fails()){

            return response()->json(
                [
                     'status'=>400,
                     'messages'=>$data->getMessageBag(),
                ]
            );

        }else{

            $meetupdata = $meetup->whereApproverId($approver_id)->whereId($request->input('meetup_id'))->first();

            date_default_timezone_set('Asia/Manila');

            if($request->input('process') == 'accept'){ //accept meetup

                $meetupdata->approved_at = date('Y-m-d h:i:s');

                $meetupdata->declined_at = null;

                $meetupdata->save();

                Notification::create([
                    'user_id' => $meetupdata->requestor_id,
                    'remarks' => auth()->user()->name. ' approved your request!',
                    'redirect_link' => route('meetup.showrequestedmeetuplist'),
                ]);

                return response()->json(
                    [
                         'status'=>200,
                         'messages'=> 'success'
                    ]
                );

            }elseif($request->input('process') == 'decline'){ //decline meetup

                $meetupdata->approved_at = null;

                $meetupdata->declined_at = date('Y-m-d h:i:s');

                $meetupdata->save();

                Notification::create([
                    'user_id' => $meetupdata->requestor_id,
                    'remarks' => auth()->user()->name. ' declined your request!',
                    'redirect_link' => route('meetup.showrequestedmeetuplist'),
                ]);

                return response()->json(
                    [
                         'status'=>200,
                         'messages'=> 'success'
                    ]
                );

            }else{

                return response()->json(
                    [
                         'status'=>404,
                         'messages'=>'Validate Meetup Process',
                    ]
                );
            }

        }
    }
    public function autogeneratenoti(){
        $user = auth()->id();
        $datenow = Carbon::now()->format('Y-m-d');
        $datenegadd1 = date("Y-m-d", strtotime($datenow. ' + 2 day'));
        //check if have pending meetup within 24 hours
        $notifwithinaday = Meetup::where('requestor_id', $user)->orWhere('approver_id', $user)
                        ->where('meetup_date', $datenegadd1)
                        ->where('approved_at', '!=', null)->get();
        foreach($notifwithinaday as $day){
            Notification::create([
                'user_id' => $day->requestor_id,
                'remarks' => auth()->user()->name. ' notify you for your appointment in ' .$day->meetup_date,
                'redirect_link' => route('meetup.showrequestedmeetuplist'),
            ]);
            Notification::create([
                'user_id' => $day->approver_id,
                'remarks' => 'notify you for your appointment in ' .$day->meetup_date,
                'redirect_link' => route('meetup.showrequestmeetuplist'),
            ]);
        }
    }
}
