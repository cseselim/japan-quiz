<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\lesson;
use DataTables;
class LessonController extends Controller
{
	/*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function lesson()
    {
    	 $lesson = lesson::all();
    	 return response()->json(['status'=>'200', 'all_lesson' => $lesson]);
    }

    public function show_lesson(Request $request)
    {
        if ($request->ajax()) {
            $data = lesson::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="' . route('lesson.details', $row->id) .'" class="edit btn btn-success btn-sm" data-id='."{$row->id}".' id="edit_school">view</a> <a href="' . route('lesson.edit', $row->id) .'" class="edit btn btn-primary btn-sm" data-id='."{$row->id}".' id="edit_school">Edit</a>  <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" data-id="'.$row->id.'" id="delete_lesson">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('home');
    }

    public function create()
    {
    	return view('createLesson');
    }

    public function store(Request $request)
    {
    	$lesson_model = new lesson;

    	$validator = Validator::make($request->all(), [
            'lesson_name' => 'required',
            'lesson_discription' => 'required',
            'video_url' => 'required',
            'word_title' => 'required',
            'quiz_title' => 'required',
        ]);
    	if ($validator->fails()) {
            return redirect()->back()->with('error', 'Lesson insert Fail');
        }else{
        	$user = $lesson_model::create($validator->validated());
            $result = $user->save();
            if ($result) {
                return redirect()->back()->with('success', 'Lesson created successfully');
            }else{
                return redirect()->back()->with('error', 'Lesson is not create');
            }
        }
    }

    public function edit($id)
    {
        $student_data = lesson::find($id);
        return view('editLesson')->with('data', $student_data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'lesson_name' => 'required',
            'lesson_discription' => 'required',
            'video_url' => 'required',
            'word_title' => 'required',
            'quiz_title' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Lesson Validator Error');
        }else{
            $lesson_id = $request->input('lesson_id');
            $result = lesson::where('id', $lesson_id)->update($validator->validated());
            if ($result) {
                return redirect()->back()->with('success', 'Lesson information update successfully');
            }else{
                return redirect()->back()->with('error', 'Lesson is not update');
            }
        }
    }

    public function details($id)
    {
        $lesson_data = lesson::find($id);
        return view('viewLesson')->with('data', $lesson_data);
    }


    public function destroy($id)
    {
        $lesson = lesson::find($id);
        $lesson->delete();
        return response()->json(['success'=>'200']);
    }
}
