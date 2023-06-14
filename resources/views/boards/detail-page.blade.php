@extends('boards.layout')

@section('content')

    <h2 class="mt-4 mb-3">Title: {{$board->title}}</h2>
    <p style="text-align: right" class="pt-2">작성일: {{$board->created_at}}</p>

    <div class="content mt-4 rounded-3 border border-secondary">
        <div class="p-3">
            {{$board->content}}
        </div>
        <div class="p-3" style="text-align: right">
            작성자: {{$board->user_name}}
        </div>
    </div>
    @if(auth()->user()->id == $board->user_id)
        <div style="text-align: right">
            <input type="button" class="btn btn-dark" value="수정"
                   onclick="location.href='{{route("boards.edit", $board)}}'"/>
            <form action="{{route('boards.destroy', $board->id)}}" method="post" style="display:inline-block;">
                {{-- delete method와 csrf 처리필요 --}}
                @method('delete')
                @csrf
                <button class="btn btn-dark">
                    <input onclick="return confirm('정말로 삭제하겠습니까?')" type="submit" value="삭제"/>
                </button>
            </form>
        </div>
    @endif

@endsection
