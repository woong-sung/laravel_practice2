@extends('boards.layout')

@section('content')
    <h2 class="mt-4 mb-3">Board View: {{$board->title}}</h2>
    <p style="text-align: right" class="pt-2">{{$board->created_at}}</p>

    <div class="content mt-4 rounded-3 border border-secondary">
        <div class="p-3">
            {{$board->content}}
        </div>
    </div>
@endsection
