<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = Result::with('symptom', 'disease')->select();
            return datatables()->of($result)
                ->addIndexColumn()
                ->addColumn('action', function($query) {
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.result.index');
    }

    public function edit(Request $request, Result $result)
    {
        $result->load('res_disease.disease', 'res_symptom.symptom', 'res_symptom.condition');

        if ($request->ajax() && isset($request->disease_list)){
            return datatables()->of($result->res_disease->sortByDesc('value'))
            ->addIndexColumn()
            ->make(true);
        }

        if ($request->ajax() && isset($request->symptom_list)){
            return datatables()->of($result->res_symptom)
            ->addIndexColumn()
            ->make(true);
        }

        $diseaseResult = $result->res_disease->sortByDesc('value')->first();
        $disease = $diseaseResult->disease;
        $name = $disease->name;
        $value = $diseaseResult->value;
        $image = $disease->image;
        $determine = $disease->determine;
        $percentage = $value * 100;

        return view('pages.result.view', compact('result', 'name', 'value', 'percentage', 'image', 'determine'));
    }

    public function getActionColumn($data)
    {
        $auth = Auth::guard('web')->check();

        $ident = Str::random(10);
        $editBtn = route($auth ? 'result.edit' : 'guest.result.edit', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';

        if($auth){
            $deleteBtn = route('result.destroy', $data->id);
            $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        }
        return $buttonAction;
    }

}
