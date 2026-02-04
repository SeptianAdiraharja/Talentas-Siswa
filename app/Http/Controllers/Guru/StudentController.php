<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')
            ->oldest()
            ->join('users', 'students.user_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->select('students.*')
            ->paginate(10);
        return view('guru.students.index', compact('students'));
    }
}
