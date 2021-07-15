@extends('layouts.app')

@section('content')
<div>
    <div class="container bg-white p-5 rounded ">
        <div class="m-3 border border-black">

            <div class="row m-3">
                <h1>posted by  </h1> <h1> "{{$user[0]['name']}}"</h1> <br>
                
            </div>
            <div class="row m-3"><p>{{$data[0]['body']}}</p></div>
        </div>
        @auth
        
    
        <div class="row m-auto">
            
            <form action="{{ route('posts.makecomment')}} " method="post" class="w-100">
                <div>
                    @csrf
                    <input type="hidden" name="id" value="{{$data[0]['id']}}">
                    <textarea class="mt-5 w-100" name="comment"  rows="4"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-100" >comment</button>
                </div>
            </form>
        </div>
        @endauth
        
        
            <ul class="list-group list-group-flush mt-5">
                @if ($comments->count())
                    <li class="list-group-item list-group-item-primary">
                        All comments
                    </li>
                    @foreach ($comments as $comment)
                    <li class="list-group-item">
                        
                        {{$comment['comment'] }}
                    </li>
                    
                 @endforeach
                 @else
                 <li class="list-group-item list-group-item-secondary">
                     No one commented
                 </li>
                 @endif
            </ul>
    
    </div>
    
  
</div>
@endsection