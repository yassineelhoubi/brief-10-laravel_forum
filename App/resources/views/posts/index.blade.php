@extends('layouts.app')

@section('content')
<div class="container">
    {{-- post form --}}
    @auth
    <div class="row bg-white p-5 rounded ">
         <form action="{{ route('posts')}}" method="post">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="150" rows="4" placeholder="Post Something" class="border border-primary w-100 @error('body') border border-danger
                
                @enderror" ></textarea>
                @error('body')
                <div class="text-danger">
                    {{ $message}}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100 "> Post</button>
            </div>
        </form>
    </div>{{-- end post form --}}
    @endauth

    
    {{-- posts list --}}
    <div class="row bg-white p-5 rounded mt-4">
    @if ($posts->count())
        @foreach ($posts as $post)
            <div class="col-12 ml-0 mr-0 mb-3 border border-primary">
                <a href="" class="text-decoration-none fw-bold">{{$post->user->name}}</a><span class="fw-light"> {{$post->created_at->diffForhumans()}}</span>
                <p>{{$post->body}}</p>
                <p class=""> {{$post->likes->count() }} {{ Str::plural('Like',$post->likes->count()) }} </p>
                {{-- delete post button --}}
                <div class="d-flex justify-content-between">
                    {{-- like and unlike button --}}
                    <div class="d-flex" >
                        @auth
                        @if (!$post->likedBy(auth()->user()) )
                        <form action="{{ route('posts.likes' , $post) }}" method="post" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-link text-primary">Like</button>
                        </form>
                        @else
                        <form action="{{ route('posts.likes' , $post) }}" method="post" class="mr-2 ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-secondary ">Unlike</button>
                        </form>
                        @endif
                        @endauth
                        <form action="{{ route('posts.comment', $post)}}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-link ">Comment</button>
                        </form>
                        
                    </div>

                    <div class="d-flex">
                        
                        @can('owner_admin', $post)
                        
                        <form action="{{ route('posts.destroy', $post)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light text-danger">Delete</button>
                        </form>
                        
                        @endcan
                        @can('owner', $post)
                        <form action="{{ route('posts.update', $post)}}" method="get">
                            @csrf
                            @method('UPDATE')
                            <button type="submit" class="btn btn-light text-success">Update</button>
                        </form>
                        @endcan
                    </div>
                    
                </div>
            </div>
            
        @endforeach
        {{$posts->links()}}
    @else
        <p>There are no posts</p>
    @endif
    </div>

</div>
@endsection