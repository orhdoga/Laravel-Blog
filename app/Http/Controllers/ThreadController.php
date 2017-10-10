<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Tag, Thread, Comment};
use Image;

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
        return view("thread.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Thread $thread)
    {
        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $location = public_path('/thumbnails/' . $filename);
            
            Image::make($thumbnail)->save($location);
        }

        Thread::create([
            "user_id" => auth()->id(),
            "tag_id" => $request->input('tag_id'),
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "thumbnail" => $thread->thumbnail = $filename,
            "body" => $request->input('body')
        ]);

        return redirect("/threads");
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

    public function postComment(Tag $tag, Thread $thread) {

        $thread->addComment([
            "user_id" => auth()->id(),
            "thread_id" => $thread->id,
            "body" => request()->input("body")
        ]);

        return redirect($thread->path());
    }

    public function deleteComment(Tag $tag, Thread $thread, Comment $comment) {

        $comment->delete();

        return redirect($thread->path());
    }

    public function editComment(Tag $tag, Thread $thread, Comment $comment) {

        return view("comment.edit", [
            "thread" => $thread,
            "comments" => $thread->comments
        ]);
    }

    public function updateComment(Tag $tag, Thread $thread, Comment $comment) {

        $comment->updateComment([
            "user_id" => auth()->user()->id,
            "thread_id" => $thread->id,
            "body" => request()->input("body")
        ]);

        $comment->save();

        return redirect($thread->path());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag, Thread $thread)
    {
        return view('thread.form', [
            "thread" => $thread
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag, Thread $thread)
    {
        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $location = public_path('/thumbnails/' . $filename);
            
            Image::make($thumbnail)->save($location);
        }

        $thread->update([
            "user_id" => auth()->id(),
            "tag_id" => $request->input('tag_id'),
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "thumbnail" => $thread->thumbnail = $filename,
            "body" => $request->input('body')
        ]);

        $thread->save();

        return redirect($thread->path());    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Thread $thread)
    {
        $thread->delete();

        return redirect('/threads');
    }
}
