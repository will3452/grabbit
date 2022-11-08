<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Post;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request){
        try {
            //get all my wishlist
        $wishlist = Wishlist::whereUserId(auth()->id())->latest()->get();
        $wishpostid = [];
        foreach($wishlist as $item){
            $wishpostid[] = $item->post_id;
        }
        $wishpostid = $wishpostid;
        if(!empty($wishpostid)){
            $ids_ordered = implode(',', $wishpostid);
        }else{
            $ids_ordered = 0;
        }
        // query wishlist to post
        $check = Post::where('status', null)->whereIn('id', $wishpostid)->orderByRaw("FIELD(id, $ids_ordered)")->get();
        $postarry = [];
        foreach($check as $item){
            if(!$item->CheckUserBlock()){
                $postarry[] = $item->id;
            }
        }
        $postarry = $postarry;
        if(!empty($postarry)){
            $ordis = implode(',', $postarry);
        }
        else{
           $ordis = 0;
        }
        $posts = Post::where('status', null)->whereIn('id', $postarry)->orderByRaw("FIELD(id, $ordis)")->get();
        return view('wishlist.index', compact('posts'));
        } catch (Exception $e) {
            return 'No post found.';
        }
    }
    public function store(Request $request){
        $data = Validator::make($request->all(),
            [
                'post_id' => ['required'],
            ]
        );
        if(!$data->fails()){
            //check if post already in wishlist
            $datas['user_id'] = auth()->id();
            $datas['post_id'] = $request->post_id;
            $wishlist = Wishlist::whereUserId($datas['user_id'])->wherePostId($datas['post_id'])->first();
            if($wishlist){
                $wishlist->delete();
                return response()->json(
                    [
                    'status' => 200,
                    'type' => 'remove',
                    'message' => 'Remove From Wishlist',
                    ]
                );
            }else{
                Wishlist::create($datas);
                return response()->json(
                    [
                    'status' => 200,
                    'type' => 'add',
                    'message' => 'Add To Wishlist',
                    ]
                );
            }

        }
    }
}
