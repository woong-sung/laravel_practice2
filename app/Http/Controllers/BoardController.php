<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Comment;

class BoardController extends Controller
{
    private $board;

    public function __construct(Board $board)
    {
        // Laravel 의 IOC(Inversion of Control) 입니다
        // 일단은 이렇게 모델을 가져오는 것이 추천 코드라고 생각하시면 됩니다.
        $this->board = $board;
    }

    public function index()
    {
        // products 의 데이터를 최신순으로 페이징을 해서 가져옵니다.
        $boards = $this->board->latest()->paginate(10);
        // products/index.blade 에 $products 를 보내줍니다
        return view('boards.index', compact('boards')); //
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(StoreBoardRequest $request)
    {
        // Request 에 대한 유효성 검사입니다, 다양한 종류가 있기에 공식문서를 보시는 걸 추천드립니다.
        // 유효성에 걸린 에러는 errors 에 담깁니다.
        $validated = $request->validated();
        $this->board['user_id'] = auth()->user()->id;
        $this->board['user_name'] = auth()->user()->name;
        $this->board['title'] = $validated['title'];
        $this->board['content'] = $validated['content'];
        $this->board->save();

        return redirect()->route('boards.index');
    }

    // 상세 페이지
    public function show(Board $board)
    {
        $comments = Comment::where('board_id', $board->id)->get();
        // show 에 경우는 해당 페이지의 모델 값이 파라미터로 넘어옵니다.
        return view('boards.detail-page', compact('board', 'comments'));
    }

    public function edit(Board $board)
    {
        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, Board $board)
    {
        $request = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        // $board는 수정할 모델 값이므로 바로 업데이트 해줍시다.
        $board->update($request);
        return redirect()->route('boards.index', $board);
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return redirect()->route('boards.index');
    }
}
