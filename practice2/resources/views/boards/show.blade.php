@extends('boards.layout')

@section('content')
    <h2 class="mt-4 mb-3">Title: {{$board->title}}</h2>
    <p style="text-align: right" class="pt-2">{{$board->created_at}}</p>

    <div class="content mt-4 rounded-3 border border-secondary">
        <div class="p-3">
            {{$board->content}}
        </div>
        <div class="p-3" style="text-align: right">
            작성자: {{$board->user_name}}
        </div>
    </div>
    @if(auth()->user()->id == $board->user_id)
        <div>
            삭제
        </div>
    @endif

@endsection
