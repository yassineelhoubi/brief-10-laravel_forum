<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

        public function index(){
            $posts = Post::orderBy('created_at' , 'desc')->with(['user', 'likes'])->simplepaginate(10);
            return view('posts.index', [
                'posts' => $posts
            ]);
        }
        public function store(Request $request){
            $this->validate($request, [
                'body' =>'required'
            ]);

            $request->user()->posts()->create($request->only('body'));
            return back();

            
        }
        public function destroy(Post $post){
            $this->authorize('owner_admin' ,$post);
           $post->delete();
           return back();
        }
        public function update(Post $post){
            $data = Post::find($post);
            return view('posts.update' ,[
                'data' => $data
            ]);
        }
        public function pushUpdate(Request $request){
            $data = Post::find($request->id);
            $data->body = $request->body;
            $data->save();
            return redirect('posts');
        }
}
