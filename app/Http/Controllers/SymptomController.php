<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SymptomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $symptom = Symptom::select();
            return datatables()->of($symptom)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    if (Auth::guard('web')->check()){
                        return $this->getActionColumn($query);
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.symptom.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('symptom.edit', $data->id);
        $deleteBtn = route('symptom.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    public function create()
    {
        return view('pages.symptom.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Symptom::create($request->all());

        return redirect()
            ->route('symptom.index')
            ->with('success', 'Symptom created successfully');
    }

    public function edit(Symptom $symptom)
    {
        return view('pages.symptom.create-edit', compact('symptom'));
    }

    public function update(Request $request, Symptom $symptom)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $symptom->update($request->all());
        return redirect()
            ->route('symptom.index')
            ->with('success', 'Symptom updated Successfully');
    }

    public function destroy(Symptom $symptom)
    {
        try {
            $symptom->delete();
            return redirect()
                ->route('symptom.index')
                ->with('success', 'symptom deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('symptom.index')
                ->with('error', 'symptom failed deleted');
        }
    }

}
