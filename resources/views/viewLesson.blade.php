@extends('layouts.app')

@section('content')
<div class="container container_padding">
    <div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd;margin-bottom: 24px;">
        <div class="col-md-6 pl-0">
          <h2 style="font-size: 30px;
            font-weight: 600;
            padding-bottom: 8px;">Lesson View</h2>
        </div>
        <div class="col-md-6 text-right pr-0">
            <a href="{{route('home')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">lesson list</a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if (\Session::has('error'))
          <div class="alert alert-success" role="alert">
              {!! \Session::get('success') !!}
          </div>
        @endif
      </div>
      <div class="col-md-12">
        @if (\Session::has('success'))
          <div class="alert alert-success" role="alert">
              {!! \Session::get('success') !!}
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      <form style="width: 100%" method="post" action="{{route('lesson.update')}}">
        @csrf
          <input type="hidden" name="lesson_id" value="{{$data->id}}">
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">lesson Name: </label>
            <input type="text" class="form-control" id="lesson_name" name="lesson_name" value="{{$data->lesson_name}}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">Lesson Discription: </label>
            <textarea rows="7" class="form-control" id="lesson_discription" name="lesson_discription" placeholder="Lesson Discription" readonly>{{$data->lesson_discription}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">video_url: </label>
            <input type="text" class="form-control" id="video_url" name="video_url" value="{{$data->video_url}}" readonly>
          </div>
{{--          <div class="form-group">--}}
{{--            <label for="exampleInputEmail1" style="font-weight: 700">Word Title: </label>--}}
{{--            <input type="text" class="form-control" id="word_title" name="word_title" value="{{$data->word_title}}" readonly>--}}
{{--          </div>--}}
{{--          <div class="form-group">--}}
{{--            <label for="exampleInputEmail1" style="font-weight: 700">Quiz Title: </label>--}}
{{--            <input type="text" class="form-control" id="quiz_title" name="quiz_title" value="{{$data->quiz_title}}" readonly>--}}
{{--          </div>--}}
        </form>
    </div>
</table>
</div>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.formvalidation.min.js') }}"></script>
@endsection
