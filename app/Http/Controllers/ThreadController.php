<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Tag, Thread, Comment};
use Image;
use DB;

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
            ->latest()
            ->search($s)
            ->paginate(100);               

        return view('thread.index', [
            "tags" => Tag::latest(),
            "threads" => $threads,
            "s" => $s
        ]);
    }

    public function sortByTag(Tag $tag) 
    {
        $threads = $tag->threads()->latest()->paginate(10);

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

        $thread = Thread::create([
            "user_id" => auth()->id(),
            "tag_id" => $request->input('tag_id'),
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "thumbnail" => $thread->thumbnail = $filename,
            "body" => $request->input('body')
        ]);

        flash(e('You have successfully created ' . $thread->title . '!'), 'success');

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

    public function postComment(Tag $tag, Thread $thread) 
    {
        $thread->addComment([
            "user_id" => auth()->id(),
            "thread_id" => $thread->id,
            "body" => request()->input("body")
        ]);

        return redirect($thread->path());
    }

    public function editComment(Tag $tag, Thread $thread, Comment $comment) 
    {
        $this->authorize('update', $comment);

        return view("comment.edit", [
            "thread" => $thread,
            "comments" => $thread->comments,
            "comment" => $comment
        ]);
    }

    public function updateComment(Tag $tag, Thread $thread, Comment $comment) 
    {
        $comment->update([
            "user_id" => $thread->user->id,
            "thread_id" => $thread->id,
            "body" => request()->input("body")
        ]);

        $comment->save();

        return redirect($thread->path());
    }

    public function deleteComment(Tag $tag, Thread $thread, Comment $comment) 
    {
        $this->authorize('delete', $comment);

        $comment->delete();

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
        $this->authorize('update', $thread);

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

        flash(e('You have successfully updated ' . $thread->title . '!'), 'info');

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
        $this->authorize('delete', $thread);

        $thread->delete();

        flash(e('You have successfully deleted ' . $thread->title . '!'), 'danger');

        return redirect('/threads');
    }
}
