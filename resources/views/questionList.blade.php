@extends('layouts.app')

@section('content')
<style>
  #question_table{
    border: 1px solid #ddd;
  }
  #question_table tr td:last-child{
    text-align: center;
  }
</style>
<div class="container container_padding">
    <div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd;margin-bottom: 24px;">
        <div class="col-md-6 pl-0">
          <h2 style="font-size: 30px;
            font-weight: 600;
            padding-bottom: 8px;">Question List</h2>  
        </div>
        <div class="col-md-6 text-right pr-0">
            <a href="{{route('question.create')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">Create Question</a>
        </div>
    </div>
    <table class="table table-separate table-head-custom " id="question_table">
        <thead>
            <tr>
                <th>Lesson Name</th>
                <th>Question Title</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <!--end: Datatable-->
</div>
<script type="text/javascript">
     $(document).ready(function() {

        var dataTable = question_table();

        dataTable = jQuery('#question_table').DataTable();

        function question_table(){
            var dataTable = jQuery('#question_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('question.list') }}",
            columns: [
                {data: 'lesson_name', name: 'lesson_name'},
                {data: 'question_title', name: 'question_title',width: '40%'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'asc']]
        });
        
        }

    /*===========School Data Delete ::Start================*/
    $(document).on('click', '#delete_question', function () {
  
        var delete_question = $(this).data("id");
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
            type: "get",
            url: '/QuestionDelete/' + delete_question,
            success: function (data) {
                if (data.success == '200') {
                    jQuery('#question_table').DataTable().destroy();
                    question_table();
                }
            }                   
        });
        }        
    });

     })//document function
</script>
@endsection
