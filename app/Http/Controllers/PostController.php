<?php

namespace App\Http\Controllers;

use Auth;

use Session;

use App\Post;

use Validator;

use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with('comment')->get();       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $action =  ['PostsController@store'] ;

        return view('posts.form')->with('action',$action);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body'  =>  'required',
            'title' =>  'required',
        ]);

        if ($validator->fails()) {
            $errors   = $validator->errors();

            $response = back()->with('errors',$errors);
        } else {

            $postModel = new Post;

            $postModel->title = $request->input('title');

            $postModel->body  = $request->input('body');
            
            $postModel->user_id = Auth::user()->id;

            $postModel->save();

            Session::flash('success','The Post has been added Successfully');

            $response = redirect('/home');
        }

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::find($id);

        $action =  ['PostsController@update',$id] ;

        return view('posts.form')->with('action',$action)->with('post',$post);

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
        $validator = Validator::make($request->all(), [
            'body'  =>  'required',
            'title' =>  'required',
        ]);

        if ($validator->fails()) {
            $errors   = $validator->errors();

            $response = back()->with('errors',$errors);
        } else {

            $post = Post::find($id);

            $post->title = $request->input('title');

            $post->body  = $request->input('body');
            
            $post->user_id = Auth::user()->id;

            $post->update();

            Session::flash('success','The Post has been updated Successfully');

            $response = redirect('/home');
        }

        return $response;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);

        $post->delete();
        
        Session::flash('success','The Post has been deleted Successfully');
      
        return redirect('/home');

    }
}
