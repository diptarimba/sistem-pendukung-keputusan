<?php

namespace App\Http\Controllers;

use App\Models\SymptomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SymptomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $symptom = SymptomCategory::select();
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

        return view('pages.symptom-category.index');
    }

    public function getActionColumn($data)
    {
        $ident = Str::random(10);
        $editBtn = route('category.edit', $data->id);
        $deleteBtn = route('category.destroy', $data->id);
        $buttonAction = '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        $buttonAction .= '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' . '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post"> <input type="hidden" name="_token" value="' . csrf_token() . '" /> <input type="hidden" name="_method" value="DELETE"> </form>';
        return $buttonAction;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.symptom-category.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        SymptomCategory::create($request->all());

        return redirect()
            ->route('category.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SymptomCategory  $symptomCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SymptomCategory $symptomCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SymptomCategory  $symptomCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SymptomCategory $category)
    {
        return view('pages.symptom-category.create-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SymptomCategory  $symptomCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SymptomCategory $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category->update($request->all());
        return redirect()
            ->route('category.index')
            ->with('success', 'Category updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SymptomCategory  $symptomCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SymptomCategory $category)
    {
        try {
            $category->delete();
            return redirect()
                ->route('category.index')
                ->with('success', 'Category deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('category.index')
                ->with('error', 'Category failed deleted');
        }
    }
}
