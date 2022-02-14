@extends('layouts.app')

@section('content')
<div class="container container_padding">
    <div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd;margin-bottom: 24px;">
        <div class="col-md-6 pl-0">
          <h2 style="font-size: 30px;
            font-weight: 600;
            padding-bottom: 8px;">Create question</h2>
        </div>
        <div class="col-md-6 text-right pr-0">
            <a href="{{route('question.list')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">Question list</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pl-0">
            @if (\Session::has('error'))
                <div class="alert alert-danger" role="alert" style="font-size: 16px;">
                    {!! \Session::get('error') !!}
                </div>
            @endif
        </div>
      <div class="col-md-12 pl-0">
        @if (\Session::has('success'))
          <div class="alert alert-success" role="alert" style="font-size: 16px;">
              {!! \Session::get('success') !!}
          </div>
        @endif
      </div>
    </div>
    <div class="row" id="question_add_form">
      <form style="width: 100%" method="post" action="{{route('store.question')}}">
        @csrf
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">lesson Name: </label>
            <select class="form-control" id="lesson_id" name="lesson_id" required>
              <option value="">Select Lesson</option>
              <?php foreach ($lesson as $value) { ?>
                <option {{ (old("lesson_id") == $value->id ? "selected":"") }} value="<?= $value->id ?>"><?= $value->lesson_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">Question Title: </label>
            <input type="text" value="{{ old('question_title') }}" class="form-control" id="question_title" name="question_title" placeholder="Question Title" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">Answer: </label>
            <div class="row" id="dynamicForm">
              <div class="col-md-6 col-12">
                <div class="row">
                  <div class="col-2">
                    <input type="checkbox" class="form-control" name="answer_text[]" >
                  </div>
                  <div class="col-10 pl-0">
                    <input type="text" value="{{ old('answer_text.0') }}" class="form-control mb-4" name="answer_text[]" placeholder="Answer" required>
                  </div>
                </div>
              </div><!--item end--->
              <div class="col-md-6 col-12">
                <div class="row">
                  <div class="col-2">
                    <input type="checkbox" class="form-control" name="answer_text[]" >
                  </div>
                  <div class="col-10 pl-0">
                    <input type="text" class="form-control mb-4" value="{{ old('answer_text.1') }}" name="answer_text[]" placeholder="Answer" required>
                  </div>
                </div>
              </div><!--item end--->
              <div class="col-md-6 col-12">
                <div class="row">
                  <div class="col-2">
                    <input type="checkbox" class="form-control" name="answer_text[]" >
                  </div>
                  <div class="col-10 pl-0">
                    <input type="text" class="form-control mb-4" value="{{ old('answer_text.2') }}" name="answer_text[]" placeholder="Answer" required>
                  </div>
                </div>
              </div><!--item end--->
              <div class="col-md-6 col-12">
                <div class="row">
                  <div class="col-2">
                    <input type="checkbox" class="form-control" name="answer_text[]" >
                  </div>
                  <div class="col-10 pl-0">
                    <input type="text" class="form-control mb-4" value="{{ old('answer_text.3') }}" name="answer_text[]" placeholder="Answer" required>
                  </div>
                </div>
              </div><!--item end--->
            </div>
            <div class="row text-center">
              <div class="col-md-12">
                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</table>
</div>

<script type="text/javascript">
    var i = 1;
    $("#add").click(function(){
        ++i;

        $("#dynamicForm").append(`<div class="col-md-6 col-12 more_ans_field">
                <div class="row">
                  <div class="col-2">
                    <input type="checkbox" class="form-control" name="answer_text[]" >
                  </div>
                  <div class="col-10 pl-0">
                    <input type="text" class="form-control mb-4" name="answer_text[]" placeholder="Answer" required>
                  </div>
                </div>
                <button type="button" class="btn btn-danger remove-tr"><span aria-hidden="true">&times;</span></button>
              </div>`);
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parent().closest('.more_ans_field').remove();
    });

</script>
@endsection
