<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_user' => Teacher::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'teachers.view_teachers',
            'title'    => 'Teachers Table'
        ];

        if ($request->ajax()) {
            $q_teachers = Teacher::select('*');
            return Datatables::of($q_teachers)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2"><a href ="' .route('/teach/edit/').'/'.$row->id.'"><i class=" fi-rr-edit"></i></div></a>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2"><a href ="' .route('/teach/delete/').'/'.$row->id.'"><i class="fi-rr-trash"></i></div>';
 
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
            'count_user' => Teacher::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'teachers.teacher_form',
            'title'      => 'Registration form',
            'teacher'    => [],
        ];
        return view('layouts.v_template',$data);
    }

    public function store(Request $request)
    {
        
       Teacher::updateOrCreate(['id' => $request->teacher_id],
            [ 
                 'teachername' => $request->teachername,
                 'fathername' => $request->fathername,
                 'mothername' => $request->mothername,
                 'address' => $request->address,
                 'email' => $request->email,
                 'mobilenumber' => $request->mobilenumber,
                ]);   

       
        return redirect('teachers');
            }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view ('view_teachers', compact ('teachers'));
    }

    public function edit($id)
    {
         
        $data = [
            'count_user' => 0,
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'teachers.teacher_form',
            'title'    =>  'Edit Form ',
            'teacher' => Teacher::find($id),
        ];
        return view('layouts.v_template',$data);
        
       

    }

    public function update(Request $request)
    {

      $teacher = Teacher::find($request->id);
      $teacher->update($request->all());
      return redirect('teachers');
        
    }

    public function destroy($id)
    { 

       
       Teacher::find($id)->delete();

        return redirect('teachers');

    }
}
