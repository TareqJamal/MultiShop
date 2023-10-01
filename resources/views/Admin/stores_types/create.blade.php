<form role="form" id="AdminForm" data-action="{{route('stores-types.store')}}" method="post" enctype= multipart/form-data>
    @csrf
    <div class="card-body">
        @foreach(config('translatable.locales') as $locale)
        <div class="form-group">
            <label for="exampleInputEmail1">Name ({{ __('locale.' . $locale)}})</label>
            <input type="text" name="type:{{$locale}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Type" data-validation="required">
        </div>
        @endforeach
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnAdd" class="btn btn-primary">Add</button>
    </div>
</form>
<script>

    $(document).ready(function ()
    {
        $('#AdminForm').on('submit',function (e)
        {
            var url = $(this).attr('data-action');
            e.preventDefault();
            $.ajax({
                url : url,
                method : "POST",
                data : new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response)
                {

                        toastr.success(response.success)
                        $('#Modal').modal('hide');
                        myTable.ajax.reload();

                },
                error: function(response) {
                     toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
