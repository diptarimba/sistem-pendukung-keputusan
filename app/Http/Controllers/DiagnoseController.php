<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\Disease;
use App\Models\Result;
use App\Models\Symptom;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    public function create()
    {
        $symptom = Symptom::get()->pluck('name', 'id');
        $condition = Condition::get();
        return view('pages.diagnose-result.create-edit', compact('symptom', 'condition'));
    }

    public function execDiagnose(Request $request)
    {
        // Get All Disease
        $disease = Disease::get();
        // For Each Disease
        $resDisease = [];
        foreach ($disease as $eachDisease) {
            $cf = 0;
            $cflama = 0;
            // Load Knowledge
            $disease->load('knowledge');

            // Foreach Knowledge
            foreach ($eachDisease->knowledge as $eachKnowledge) {
                foreach ($request->symptom as $eachSymptom => $eachCondition) {
                    if ($eachKnowledge->symptom_id == $eachSymptom) {
                        $cf = ($eachKnowledge->measure_of_belief - $eachKnowledge->measure_of_disbelief) * $eachCondition;
                        if (($cf >= 0) && ($cf * $cflama >= 0)) {
                            $cflama = $cflama + ($cf * (1 - $cflama));
                          }
                          if ($cf * $cflama < 0) {
                            $cflama = ($cflama + $cf) / (1 - Min(abs($cflama), abs($cf)));
                          }
                          if (($cf < 0) && ($cf * $cflama >= 0)) {
                            $cflama = $cflama + ($cf * (1 + $cflama));
                          }
                    }
                }
            }
            if ($cf > 0){
                array_push($resDisease, [
                    $eachDisease->id => number_format($cflama, 4)
                ]);
            }
        }

        arsort($resDisease);

        foreach($resDisease as $eachRes){
            foreach($eachRes as $keyRes => $valueRes){
                $result = Result::create(['value' => $valueRes]);
                break 2;
            }
        }

        // $result = Result::create(['value' => $resDisease[0]]);

        foreach($resDisease as $eachKeyResDisease => $eachValueResDisease){
            $result->res_disease()->create(['disease_id' => $eachKeyResDisease]);
        }

        foreach($request->all() as $eachKeySymptom => $eachValueSymptom){
            $result->res_symptom()->create(['symptom_id' => $eachKeySymptom]);
        }

        return redirect()->route('guest.diagnose.create')->with('success', 'Create Diagnose Successfully');
    }
}
