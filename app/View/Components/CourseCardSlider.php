<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CourseCardSlider extends Component
{
    public $id;
    public $thumbnail;
    public $title;
    public $duration;
    public $url;
    public $instructor;
    public $price;
    public $discount;
    public $lessons;
    public $students;
    public $rating;
    public $variant;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $id,
        $thumbnail,
        $title,
        $duration,
        $url,
        $instructor,
        $price,
        $discount,
        $lessons,
        $students,
        $rating,
        $variant = "default"
    ) {
        $this->id = $id;
        $this->thumbnail = $thumbnail;
        $this->title = $title;
        $this->duration = $duration;
        $this->url = $url;
        $this->instructor = $instructor;
        $this->price = $price;
        $this->discount = $discount;
        $this->lessons = $lessons;
        $this->students = $students;
        $this->rating = $rating;
        $this->variant = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-card-slider');
    }
}