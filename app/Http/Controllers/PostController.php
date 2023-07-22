<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $post = Post::select();
            return datatables()->of($post)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.post.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('post.edit', $data->id);
        $deleteBtn = route('post.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    public function create()
    {
        return view('pages.post.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'determine' => 'required',
            'suggestion' => 'required',
            'image' => 'required',
        ]);

        Post::create($request->all());

        return redirect()
            ->route('post.index')
            ->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('pages.post.create-edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required',
            'determine' => 'required',
            'suggestion' => 'required',
            'image' => 'sometimes',
        ]);

        $post->update($request->all());
        return redirect()
            ->route('post.index')
            ->with('success', 'Post updated Successfully');
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()
                ->route('post.index')
                ->with('success', 'post deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('post.index')
                ->with('error', 'post failed deleted');
        }
    }

}
