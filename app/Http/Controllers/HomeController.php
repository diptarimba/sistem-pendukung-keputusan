<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use App\Models\Disease;
use App\Models\Knowledge;
use App\Models\Result;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $files = Storage::files('placeholder/slider');
        $rawSlider = preg_grep('/^.*\.png$/i', $files);
        $slider = array_map([Storage::class, 'url'], $rawSlider);

        $homeData = [
            $this->getDataCount(Disease::class, "Disease Total", 'fa-solid fa-tasks fa-fw', 'disease.index'),
            $this->getDataCount(Knowledge::class, "Knowledge Total", 'fa-solid fa-book-open fa-fw', 'knowledge.index'),
            $this->getDataCount(Condition::class, "Condition Total", 'fa-solid fa-cogs fa-fw', 'condition.index'),
            $this->getDataCount(Condition::class, "Post Total", 'fa-solid fa-file-import fa-fw', 'post.index'),
            $this->getDataCount(Symptom::class, "Symptom Total", 'fa-solid fa-thermometer-three-quarters fa-fw', 'symptom.index'),
            $this->getDataCount(Result::class, "Result Total", 'fa-solid fa-vial fa-fw', 'result.index'),
            $this->getDataCount(User::class, "User Total", 'fa-solid fa-user fa-fw', 'user.index'),
        ];

        return view('pages.home.index', compact('slider', 'homeData'));
    }

    function getDataCount($model, $name, $icon, $routeName) {
        return [
            'name' => $name,
            'data' => $model::count(),
            'icon' => $icon,
            'url' => route($routeName)
        ];
    }
}

