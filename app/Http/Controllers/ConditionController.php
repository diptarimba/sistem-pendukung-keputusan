<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConditionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $condition = Condition::select();
            return datatables()->of($condition)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    if (Auth::guard('web')->check()){
                        return $this->getActionColumn($query);
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.condition.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('condition.edit', $data->id);
        $deleteBtn = route('condition.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    public function create()
    {
        return view('pages.condition.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Condition::create($request->all());

        return redirect()
            ->route('condition.index')
            ->with('success', 'Condition created successfully');
    }

    public function edit(Condition $condition)
    {
        return view('pages.condition.create-edit', compact('condition'));
    }

    public function update(Request $request, Condition $condition)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $condition->update($request->all());
        return redirect()
            ->route('condition.index')
            ->with('success', 'Condition updated Successfully');
    }

    public function destroy(Condition $condition)
    {
        try {
            $condition->delete();
            return redirect()
                ->route('condition.index')
                ->with('success', 'condition deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('condition.index')
                ->with('error', 'condition failed deleted');
        }
    }

}
