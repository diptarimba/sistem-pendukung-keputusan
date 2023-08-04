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
            $this->getDataCount(Disease::class, __('home.Disease'), 'fa-solid fa-tasks fa-fw', 'disease.index'),
            $this->getDataCount(Knowledge::class, __('home.Knowledge'), 'fa-solid fa-book-open fa-fw', 'knowledge.index'),
            $this->getDataCount(Condition::class,  __('home.Condition'), 'fa-solid fa-cogs fa-fw', 'condition.index'),
            $this->getDataCount(Condition::class,  __('home.Post'), 'fa-solid fa-file-import fa-fw', 'post.index'),
            $this->getDataCount(Symptom::class, __('home.Symptom'), 'fa-solid fa-thermometer-three-quarters fa-fw', 'symptom.index'),
            $this->getDataCount(Result::class, __('home.Result'), 'fa-solid fa-vial fa-fw', 'result.index'),
            $this->getDataCount(User::class, __('home.User'), 'fa-solid fa-user fa-fw', 'user.index'),
        ];

        return view('pages.home.index', compact('slider', 'homeData'));
    }

    public function index_guest()
    {
        $files = Storage::files('placeholder/slider');
        $rawSlider = preg_grep('/^.*\.png$/i', $files);
        $slider = array_map([Storage::class, 'url'], $rawSlider);

        $homeData = [
            $this->getDataCount(Disease::class, __('home.Disease'), 'fa-solid fa-tasks fa-fw', 'guest.disease.index'),
            $this->getDataCount(Knowledge::class, __('home.Knowledge'), 'fa-solid fa-book-open fa-fw', 'guest.knowledge.index'),
            $this->getDataCount(Condition::class,  __('home.Condition'), 'fa-solid fa-cogs fa-fw', 'guest.condition.index'),
            $this->getDataCount(Condition::class, __('home.Post'), 'fa-solid fa-file-import fa-fw', 'guest.post.index'),
            $this->getDataCount(Symptom::class, __('home.Symptom'), 'fa-solid fa-thermometer-three-quarters fa-fw', 'guest.symptom.index'),
            $this->getDataCount(Result::class, __('home.Result'), 'fa-solid fa-vial fa-fw', 'guest.result.index'),
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

