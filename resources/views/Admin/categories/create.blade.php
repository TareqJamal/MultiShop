<form role="form" id="categoryForm" data-action="{{route('categories.store')}}" method="post" enctype= multipart/form-data>
    @csrf
    <div class="card-body">
        @foreach(config('translatable.locales') as $locale)
        <div class="form-group">
            <label for="exampleInputEmail1">Name ({{ __('locale.' . $locale)}})</label>
            <input type="text" name="name:{{$locale}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Store Name" data-validation="required">
        </div>
        @endforeach
            <div class="form-group">
                <label>Store Type</label>
                <select class="form-control" name="store_id">
                    <option>Choose</option>
                    @foreach($data as $store)
                        <option value="{{$store->id}}">{{$store->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image </label>
                <input type="file" name="image" class="form-control" id="exampleInputEmail1" data-validation="required">
            </div>
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
        $('#categoryForm').on('submit',function (e)
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
