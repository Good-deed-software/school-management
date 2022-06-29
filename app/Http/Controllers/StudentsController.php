<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_user' => Student::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_students',
            'title'    => 'Student Table'
        ];

        if ($request->ajax()) {
            $q_student = Student::select('*');
            return Datatables::of($q_student)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2"><a href="' .url('/st/edit/').'/'.$row->id.'"> <i class=" fi-rr-edit"></i></div></a>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 "><a href="' .url('/st/delete/').'/'.$row->id.'"><i class="fi-rr-trash"></i></div></a>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.v_template',$data);
    }

    public function create(Request $request)
    {    
        
        $data = [
            'count_user' => Student::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.students_form',
            'title'    => 'Students Form',
            "student"  => [],
        ];

        return view('layouts.v_template',$data);
    }

    public function store(Request $request)
    {
        Student::updateOrCreate(['id' => $request->student_id],
                [
                 'student_name' => $request->student_name,
                 'father_name' => $request->father_name,
                 'mother_name' => $request->mother_name,
                 'student_class' => $request->student_class,
                 'student_address' => $request->student_address,
                 'mob_number' => $request->mob_number,
                 
                ]);        

        //return response()->json(['success'=>'User saved successfully!']);

        Student::create($request->except('_token'));
        return redirect('students')->with('success','added successfully');
    }

    public function show($id)
    {
        $students = Student::find($id);
        return view('view_students', compact(''));
    }

    public function edit($id)
    {
        $data = [
            'count_user' => 0,
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.students_form',
            'title'    => 'Edit form',
            'student' => Student::find($id),
        ];
        
        return view('layouts.v_template',$data);
       

    }

    public function update(Request $request)
    {
        
        $student = student::find($request->id);
       
        $student->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        Student::find($id)->delete();

        return redirect('students');
    }
}
