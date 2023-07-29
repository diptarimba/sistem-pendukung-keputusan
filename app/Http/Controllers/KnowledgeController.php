<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Knowledge;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KnowledgeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $knowledge = Knowledge::with('disease', 'symptom')->select();
            return datatables()->of($knowledge)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    if (Auth::guard('web')->check()){
                        return $this->getActionColumn($query);
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.knowledge.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('knowledge.edit', $data->id);
        $deleteBtn = route('knowledge.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    public function create()
    {
        $disease = Disease::get()->pluck('name', 'id');
        $symptom = Symptom::get()->pluck('name', 'id');

        return view('pages.knowledge.create-edit', compact('disease', 'symptom'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'measure_of_belief' => 'required',
            'measure_of_disbelief' => 'required',
            'disease_id' => 'required',
            'symptom_id' => 'required',
        ]);

        Knowledge::create($request->all());

        return redirect()
            ->route('knowledge.index')
            ->with('success', 'Knowledge created successfully');
    }

    public function edit(Knowledge $knowledge)
    {
        $disease = Disease::get()->pluck('name', 'id');
        $symptom = Symptom::get()->pluck('name', 'id');

        return view('pages.knowledge.create-edit', compact('knowledge','disease', 'symptom'));
    }

    public function update(Request $request, Knowledge $knowledge)
    {
        $request->validate([
            'measure_of_belief' => 'required',
            'measure_of_disbelief' => 'required',
            'disease_id' => 'required',
            'symptom_id' => 'required',
        ]);

        $knowledge->update($request->all());
        return redirect()
            ->route('knowledge.index')
            ->with('success', 'Knowledge updated Successfully');
    }

    public function destroy(Knowledge $knowledge)
    {
        try {
            $knowledge->delete();
            return redirect()
                ->route('knowledge.index')
                ->with('success', 'knowledge deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('knowledge.index')
                ->with('error', 'knowledge failed deleted');
        }
    }

}
