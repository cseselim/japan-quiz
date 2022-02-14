@extends('layouts.app')

@section('content')
<div class="container container_padding">
    <div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd;margin-bottom: 24px;">
        <div class="col-md-6 pl-0">
          <h2 style="font-size: 30px;
            font-weight: 600;
            padding-bottom: 8px;">Lesson List</h2>
        </div>
        <div class="col-md-6 text-right pr-0">
            <a href="{{route('word.list')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">lesson list</a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 pl-0">
        @if (\Session::has('error'))
          <div class="alert alert-success" role="alert" style="font-size: 16px;">
              {!! \Session::get('success') !!}
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
    <div class="row">
      <form style="width: 100%" method="post" action="{{route('store.word')}}">
        @csrf
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">lesson Name: </label>
            <select class="form-control" id="lesson_id" name="lesson_id" required>
              <option value="">Select Lesson</option>
              <?php foreach ($lesson as $value) { ?>
                <option value="<?= $value->id ?>"><?= $value->lesson_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: 700">lesson Word: </label>
            <input type="text" class="form-control" id="word" name="word" placeholder="lesson Word" required>
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1" style="font-weight: 700">Word Meaning: </label>
              <input type="text" class="form-control" id="meaning" name="meaning" placeholder="Word Meaning" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</table>
</div>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.formvalidation.min.js') }}"></script>
@endsection
