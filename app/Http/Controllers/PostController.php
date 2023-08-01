<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $post = Post::select();
            return datatables()->of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($query) {
                    if (Auth::guard('web')->check()){
                        return $this->getActionColumn($query);
                    } else {
                        return $this->getGuestActionColumn($query);
                    }
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

    public function getGuestActionColumn($data)
    {
        $editBtn = route('guest.post.edit', $data->id);
        return '<button type="button" onclick="fetchDataAndPopulateModal(\'' . $editBtn . '\')" class="btn mx-1 my-1 btn-sm btn-secondary read-post">View Post</button>';
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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->storePublicly('post');
            $imageUrl = Storage::url($image);
        }

        Post::create(array_merge($request->all(), [
            'image' => $imageUrl
        ]));

        return redirect()
            ->route('post.index')
            ->with('success', 'Post created successfully');
    }

    public function edit(Request $request, Post $post)
    {

        if($request->ajax())
        {
            return response()->json(['data' => $post->toArray()], 200);
        }

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

        $post->update(array_merge(
            $request->all(),
            [
                'image' => $request->hasFile('image') ? Storage::url($request->file('image')->storePublicly('post')) : $post->image
            ]
        ));
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
