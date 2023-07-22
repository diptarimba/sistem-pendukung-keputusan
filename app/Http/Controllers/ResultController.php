<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = Result::select();
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

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('result.edit', $data->id);
        $deleteBtn = route('result.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

}
