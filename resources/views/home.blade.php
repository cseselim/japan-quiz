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
            <a href="{{route('create.lesson')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">create lesson</a>
        </div>
    </div>
    <table class="table table-separate table-head-custom " id="lesson_table">
        <thead>
            <tr>
                <th>id</th>
                <th>Lesson Name</th>
                <th>Lesson Discription</th>
                <th>Word Title</th>
                <th>Quiz Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <!--end: Datatable-->
</div>
<script type="text/javascript">
     $(document).ready(function() {

        var dataTable = lesson_list();

        dataTable = jQuery('#lesson_table').DataTable();

        function lesson_list(){
            var dataTable = jQuery('#lesson_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('lessonlist.list') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'lesson_name', name: 'lesson_name'},
                {data: 'lesson_discription', name: 'lesson_discription',width: '40%'},
                {data: 'word_title', name: 'word_title'},
                {data: 'quiz_title', name: 'quiz_title'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'asc']]
        });
        
        }

    /*===========School Data Delete ::Start================*/
    $(document).on('click', '#delete_lesson', function () {
  
        var lesson_id = $(this).data("id");
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
            type: "get",
            url: '/lessonDelete/' + lesson_id,
            success: function (data) {
                if (data.success == '200') {
                    jQuery('#lesson_table').DataTable().destroy();
                    lesson_list();
                }
            }                   
        });
        }        
    });

     })//document function
</script>
@endsection
