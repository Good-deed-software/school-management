<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
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
            'content'    => 'students.list',
            'title'    => 'Students'
        ];

        if ($request->ajax()) {
            $q_students = Student::select('*');
            return Datatables::of($q_students)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $url = route('student.edit',$row->id);
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2"><a href="'.$url.'"> <i class="fi-rr-edit"></i></a></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteUser"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.v_template',$data);
    }

    public function create()
    {
        $data = [
            'count_user' => 0,
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'students.student_form',
            'title'    => 'Students',
            'students' => [], 
        ];
        return view('layouts.v_template',$data);
    }

    public function store(Request $request)
    {
        Student::updateOrCreate(['id' => $request->student_id],
                [
                   
                  'name' => $request->name,
                 'fathername' => $request->fathername,
                 'mothername' => $request->mothername,
                 'oldclass' => $request->oldclass,
                 'city' => $request->city,
                ]);        

        return back()->with('success','User saved successfully!');
    }

    public function show($id)
    {
       
        $students = Student::find($id);
        // dd(123);
        return view('students.list' ,compact('students'));
       
    }

    public function edit($id)
    {

       
        $data = [
            'count_user' => 0,
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'students.student_form',
            'title'    => 'Update User',
            'students' => Student::find($id), 
        ];
       
        return view('layouts.v_template' , $data);

        return redirect('students.list');

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

        return response()->json(['success'=>'Customer deleted!']);
    }
}
