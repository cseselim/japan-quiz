@extends('layouts.app')

@section('content')
<style>
  #word_table{
    text-align: center;
    border: 1px solid #ddd;
  }
</style>
<div class="container container_padding">
    <div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd;margin-bottom: 24px;">
        <div class="col-md-6 pl-0">
          <h2 style="font-size: 30px;
            font-weight: 600;
            padding-bottom: 8px;">Word List</h2>  
        </div>
        <div class="col-md-6 text-right pr-0">
            <a href="{{route('create.word')}}" class="btn btn-success" style="font-size: 15px;text-transform: capitalize;padding: 8px 12px;">create word</a>
        </div>
    </div>
    <table class="table table-separate table-head-custom " id="word_table">
        <thead>
            <tr>
                <th>Lesson Name</th>
                <th style="text-align: center;">Word</th>
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

        var dataTable = word_list();

        dataTable = jQuery('#word_table').DataTable();

        function word_list(){
            var dataTable = jQuery('#word_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('word.list') }}",
            columns: [
                {data: 'lesson_name', name: 'lesson_name'},
                {data: 'word', name: 'word',width: '40%'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'asc']]
        });
        
        }

    /*===========School Data Delete ::Start================*/
    $(document).on('click', '#delete_word', function () {
  
        var word_id = $(this).data("id");
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
            type: "get",
            url: '/wordDelete/' + word_id,
            success: function (data) {
                if (data.success == '200') {
                    jQuery('#word_table').DataTable().destroy();
                    word_list();
                }
            }                   
        });
        }        
    });

     })//document function
</script>
@endsection

