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
        $disease = Disease::with('knowledge')->get();
        // For Each Disease
        $resDisease = [];
        foreach ($disease as $eachDisease) {
            $cf = 0;
            $cflama = 0;

            $symptomRequest = array_filter($request->symptom, function ($value) {
                return $value[0] !== null && $value[1] !== null;
            });

            // Foreach Knowledge
            foreach ($eachDisease->knowledge as $eachKnowledge) {
                foreach ($symptomRequest as $eachSymptom => $eachCondition) {
                    if ($eachKnowledge->symptom_id == $eachSymptom) {
                        $cf = ($eachKnowledge->measure_of_belief - $eachKnowledge->measure_of_disbelief) * $eachCondition[0];
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
            if ($cf > 0) {
                array_push($resDisease, [
                    $eachDisease->id => number_format($cflama, 4)
                ]);
            }
        }

        arsort($resDisease);

        $first = true;

        foreach ($resDisease as $eachRes) {
            foreach ($eachRes as $eachKeyResDisease => $eachValueResDisease) {
                if ($first) {
                    $result = Result::create(['value' => $eachValueResDisease]);
                    $first = false;
                }
                $result->res_disease()->create(['disease_id' => $eachKeyResDisease, 'value' => $eachValueResDisease]);
            }
        }

        foreach ($symptomRequest as $eachKeySymptom => $eachValueSymptom) {
            $result->res_symptom()->create(['symptom_id' => $eachKeySymptom, 'condition_id' => $eachValueSymptom[1]]);
        }

        return redirect()->route('guest.result.edit', $result->id)->with('success', 'Create Diagnose Successfully');
    }
}
