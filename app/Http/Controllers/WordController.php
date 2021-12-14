<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\word;
use App\lesson;
use DataTables;

class WordController extends Controller
{
    public function word($lesson_id="")
    {
    	$all_word = word::with('all_word')->where('lesson_id',$lesson_id)->get();
    	return $all_word;
    }

    public function index(Request $request)
    {
    	/*$all_word = lesson::with('all_word')->get();
    	return view('wordList',['word' => $all_word]);*/
        if ($request->ajax()) {
            $words = DB::table('lessons')
            ->join('words', 'lessons.id', '=', 'words.lesson_id')
            ->select('words.id','lessons.id as lesson_id', 'lessons.lesson_name', 'words.word')
            ->get();
//            dd($words);exit();
            $uniqueLessonId = $words->pluck('lesson_id')->unique();
            $newWords = collect([]);
            foreach ($uniqueLessonId as $id){
                $tags = $words->where('lesson_id',$id)->pluck('word')->implode(', ');
                $lessonName = $words->where('lesson_id',$id)->first()->lesson_name;
                $newWords->add([
                    'lesson_id' => $id,
                   'lesson_name' => $lessonName,
                   'word' => $tags
                ]);
            }

            return Datatables::of($newWords)
                    ->addIndexColumn()
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="' . route('word.view', $row['lesson_id']) .'" class="edit btn btn-primary btn-sm" data-id='."{$row['lesson_id']}".' id="edit_word">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('wordList');
    }

    public function create()
    {
        $lessonList = lesson::all('id','lesson_name');
        return view('wordCreate',['lesson' => $lessonList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
            'word' => 'required',
        ]);
        $word = new word;
        $word->lesson_id = $request->lesson_id;
        $word->word = $request->word;
        $result = $word->save();
        if ($result) {
            return redirect()->back()->with('success', 'Word created successfully');
        }else{
            return redirect()->back()->with('error', 'Word is not create');
        }
    }


    public function view(Request $request)
    {
        $id = request()->segment(2);
        if ($request->ajax()) {
            $words = DB::table('lessons')
                ->join('words', 'lessons.id', '=', 'words.lesson_id')
                ->select('words.id','lessons.id as lesson_id', 'lessons.lesson_name', 'words.word')
                //->where('words.lesson_id', $id)
                ->get();

            return Datatables::of($words)
                ->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="' . route('word.edit',[$row->lesson_id, $row->id]) .'" class="edit btn btn-primary btn-sm" data-id='."{$row->id}".' id="edit_word">Edit</a>  <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" data-id="'.$row->id.'" id="delete_word">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('wordListView');
    }

    public function edit($lesson,$id)
    {
        $all_lesson = lesson::all();
        $word_data = word::find($id);
        return view('wordEdit',compact('word_data', 'all_lesson'));
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required',
            'word' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Word Validator Error');
        }else{
            $word_id = $request->input('word_id');
            $result = word::where('id', $word_id)->update($validator->validated());
            if ($result) {
                return redirect()->back()->with('success', 'Word update successfully');
            }else{
                return redirect()->back()->with('error', 'Word is not update');
            }
        }
    }

    public function destroy($id)
    {
        $word = word::find($id);
        $word->delete();
        return response()->json(['success'=>'200']);
    }
}
