<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class MeetupController extends Controller
{
    //

    public function create(Request $request){
        
        $id_post = $request->id_post;

        if($id_post){
            
            $posts = Post::whereId($id_post)->first();

            if($posts){

                if(!$posts->checkUserAuthPost()){

                    return view('meetup.create', compact('posts'));

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
    public function store(Request $request){

        $meetup = new Meetup;

        $data = Validator::make($request->all(),
            [
                'meetup_date' => 'required|date',
                'post_id' => 'required',
                'remarks' => 'required'
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

            $posts = Post::whereId($request->input('post_id'))->first();

            $request['requestor_id'] = auth()->user()->id;
            $request['approver_id'] = $posts->user_id;

            if($posts){
                
                //check if user have already meetup

                $check = $meetup->whereRequestorId($request['requestor_id'])->whereApproverId($request['approver_id'])->wherePostId($request->input('post_id'))->first();

               

               if($check){
                    return response()->json(
                        [
                            'status'=>404,
                            'messages'=>'You Already Set Meeting Up On this Post'
                        ]
                    );
               }else{

                // create_notification ...notif here

                     $meetup->create($request->all());

                     return response()->json(
                        [
                            'status'=>204,
                            'messages'=>'success'
                        ]
                    );

               }

              
            }else{
                return response()->json(
                    [
                         'status'=>404,
                         'messages'=>'Post Not Found'
                    ]
                );
            }

        }
    }
    public function showrequestmeetuplist(Request $request){

        $meetup = new Meetup;

        $approver_id = auth()->user()->id;

        $meetupdata = $meetup->whereApproverId($approver_id)->latest()->take(25)->paginate(5);

        return view('meetup.request_meetup' ,compact('meetupdata'));

    }
    public function processmeetupview(Request $request){

        $meetup = new Meetup;

        $approver_id = auth()->user()->id;

        $meetupdata = $meetup->whereApproverId($approver_id)->whereId($request->meetup_id)->first();

        if($meetupdata){

            return view('meetup.process', compact('meetupdata'));

        }else{

            abort(404);
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

                // create_notification ...notif here

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

                // create_notification ...notif here

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
}
