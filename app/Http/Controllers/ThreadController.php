<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Tag, Thread, Comment};

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s = $request->input("s");
        $threads = Thread::with("tag")
            ->search($s)
            ->paginate(10);        

        return view('thread.index', [
            "tags" => Tag::all(),
            "threads" => $threads,
            "s" => $s
        ]);
    }

    public function sortByTag(Tag $tag) {
        $threads = $tag->threads()->paginate(10);

        return view("thread.index", [
            "threads" => $threads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function postComment(Tag $tag, Thread $thread, Comment $comment) {

        $thread->addComment([
            "user_id" => auth()->user()->id,
            "thread_id" => $thread->id,
            "body" => request()->input("body")
        ]);

        return redirect($thread->path());
    }

    public function deleteComment(Tag $tag, Thread $thread, Comment $comment) {

        $comment->delete();

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag, Thread $thread)
    {
        return view("thread.show", [
            "thread" => $thread,
            "comments" => $thread->comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
