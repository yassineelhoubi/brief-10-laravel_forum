@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white p-5 rounded ">

         <form action="{{ route('posts.pushUpdate')}}" method="POST">
       @csrf
        <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <input type="hidden" name="id" value="{{$data[0]['id']}}">
            <textarea name="body" id="body" cols="150" rows="4" placeholder="Post Something" class="border border-primary w-100 @error('body') border border-danger
            @enderror" >{{$data[0]['body']}}</textarea>
            @error('body')
            <div class="text-danger">
                {{ $message}}
            </div>
            @enderror
        </div>
        <div>
              <button type="submit" class="btn btn-success w-100 "> Update</button>
        </div>
        </form>
    </div>
</div>
@endsection