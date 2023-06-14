{{-- layout 으로 --}}
@extends('boards.layout')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <h2 class="mt-4 mb-3">Board List</h2>

    <a href="{{route("boards.create")}}">
        <button type="button" class="btn btn-dark" style="float: right;">Create</button>
    </a>


    <table class="table table-striped table-hover" style="font-size: 20px;">
        <colgroup>
            <col width="15%"/>
            <col width="40%"/>
            <col width="15%"/>
            <col width="15%"/>
            <col width="15%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Title</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        {{-- blade 에서는 아래 방식으로 반복문을 처리합니다. --}}
        {{-- Board Controller의 index에서 넘긴 $boards(board 데이터 리스트)를 출력해줍니다. --}}
        @foreach ($boards as $key => $board)
            <tr>
                <th scope="row">{{$key+1 + (($boards->currentPage()-1) * 10)}}</th>
                <td>
                    <a href="{{route("boards.show", $board->id)}}">{{$board->title}}</a>
                </td>
                <td>
                    {{$board->user_name}}
                </td>
                <td style="font-size: 15px; vertical-align: middle">{{$board->created_at}}</td>
                <td>
                    @if($board->user_id == @auth()->user()->id)
                        <input type="button" class="btn btn-outline-dark" value="수정"
                               onclick="location.href='{{route("boards.edit", $board)}}'"/>
                        <button class="btn btn-outline-dark">
                            <form action="{{route('boards.destroy', $board->id)}}" method="post"
                                  style="display:inline-block; height: 9px">
                                {{-- delete method와 csrf 처리필요 --}}
                                @method('delete')
                                @csrf
                                <input onclick="return confirm('정말로 삭제하겠습니까?')" type="submit" value="삭제"/>
                            </form>
                        </button>

                    @else
                        <input type="button" class="btn btn-outline-dark" value="수정" onclick="alert('작성자가아닙니다')"/>
                        <input type="button" class="btn btn-outline-dark" value="삭제" onclick="alert('작성자가아닙니다')"/>
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- 라라벨 기본 지원 페이지네이션 --}}
    {!! $boards->links() !!}
@endsection
