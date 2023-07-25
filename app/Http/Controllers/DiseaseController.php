<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $disease = Disease::select();
            return datatables()->of($disease)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.disease.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('disease.edit', $data->id);
        $deleteBtn = route('disease.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    public function create()
    {
        return view('pages.disease.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'determine' => 'required',
            'suggestion' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image')->storePublicly('disease');
            $imageUrl = Storage::url($image);
        }

        Disease::create(array_merge($request->all(), ['image' => $imageUrl]));

        return redirect()
            ->route('disease.index')
            ->with('success', 'Disease created successfully');
    }

    public function edit(Disease $disease)
    {
        return view('pages.disease.create-edit', compact('disease'));
    }

    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'name' => 'required',
            'determine' => 'required',
            'suggestion' => 'required',
            'image' => 'sometimes',
        ]);

        $disease->update(array_merge($request->all(), ['image' => $request->hasFile('image') ? Storage::url($request->file('image')->storePublicly('disease')) : $disease->image]));
        return redirect()
            ->route('disease.index')
            ->with('success', 'Disease updated Successfully');
    }

    public function destroy(Disease $disease)
    {
        try {
            $disease->delete();
            return redirect()
                ->route('disease.index')
                ->with('success', 'disease deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('disease.index')
                ->with('error', 'disease failed deleted');
        }
    }

}
