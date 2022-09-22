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

    public function cancel(){


    }
    public function approved(){


    }
    public function index(){

        
    }
}
