<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\question;
use App\answer;
use App\lesson;
use DataTables;

class QuestionController extends Controller
{
    public function question($question_id="")
    {
    	$all_question = question::with('all_question')->with('question_ans')->where('lesson_id',$question_id)->get();
    	 return response()->json(['status'=>'200', 'questions' => $all_question]);
    }

    public function index(Request $request){
        if ($request->ajax()) {
        $questions = DB::table('lessons')
        ->join('questions', 'lessons.id', '=', 'questions.lesson_id')
        ->select('questions.id','lessons.lesson_name', 'questions.question_title')
        ->get();
        return Datatables::of($questions)
                ->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="' . route('Question.edit', $row->id) .'" class="edit btn btn-primary btn-sm" data-id='."{$row->id}".' id="edit_word">Edit</a>  <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" data-id="'.$row->id.'" id="delete_question">Delete</a>';

                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('questionList');
    }

    public function create(){
    	$lessonList = lesson::all('id','lesson_name');
    	return view('createQuestion',['lesson' => $lessonList]);
    }


    public function store(Request $request){

         $request->validate([
            'lesson_id' => 'required',
            'question_title' => 'required',
             'answer_text' => 'required',
        ]);

        if (in_array('on',$request->input('answer_text'))) {
            $question = new question;
            $question->lesson_id = $request->lesson_id;
            $question->question_title = $request->question_title;
            $question->question_explanation = $request->question_explanation;
            $question->save();

            $size = sizeof($request->answer_text);

            if ($question->id) {
                for ($i = 0; $i < $size; $i++) {
                    if ($request->answer_text[$i] == 'on') {
                        $answer = answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $request->answer_text[$i + 1],
                            'answer' => '1',
                        ]);
                        $i = $i + 1;
                    } else {
                        $answer = answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $request->answer_text[$i],
                        ]);
                    }
                    $ans = $answer->save();
                }
                if ($ans) {
                    return redirect()->back()->with('success', 'Question created successfully');
                } else {
                    return redirect()->back()->with('error', 'Question is not create');
                }
            }
        }else{
            return redirect()->back()->with('error', 'Select question correct answer.');
        }

    }

    public function edit($id)
    {
        $all_lesson = lesson::all();
        $question = question::find($id);
        $answer = answer::where('question_id', $id)->get();
        return view('questionEdit',compact('all_lesson','question','answer'));
    }

    public function update(Request $request)
    {
        //dd($request->all());exit();
        $request->validate([
            'lesson_id' => 'required',
            'question_title' => 'required',
            'answer_text' => 'required',
        ]);

        if (in_array('on',$request->input('answer_text'))){
            $question_id = $request->input('question_id');
            $question_array = array(
                'lesson_id' => $request->lesson_id,
                'question_title' => $request->question_title,
                'question_explanation' => $request->question_explanation,
            );
            question::where('id', $question_id)->update($question_array);


            $size = sizeof($request->answer_text);

            if ($question_id) {
                answer::where('question_id',$question_id)->delete();
                for ($i = 0; $i < $size; $i++) {
                    if ($request->answer_text[$i] == 'on') {
                        $answer = answer::create([
                            'question_id' => $question_id,
                            'answer_text' => $request->answer_text[$i+1],
                            'answer' => '1',
                        ]);
                        $i = $i+1;
                    }else{
                        $answer = answer::create([
                            'question_id' => $question_id,
                            'answer_text' => $request->answer_text[$i],
                        ]);
                    }
                    $ans = $answer->save();
                }
                if ($ans) {
                    return redirect()->back()->with('success', 'Question update successfully');
                }else{
                    return redirect()->back()->with('error', 'Question is not update');
                }
            }
        }else{
            return redirect()->back()->with('error', 'Select question correct answer.');
        }

    }

    public function destroy($id)
    {
        $word = question::find($id);
        $word->delete();
        return response()->json(['success'=>'200']);
    }
}
