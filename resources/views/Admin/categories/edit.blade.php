<form role="form" id="CategoryFormEdit" data-action="{{route('categories.update',$data->id)}}" method="post" enctype= multipart/form-data>
    @method('Put')
    @csrf
    <div class="card-body">
        @foreach(config('translatable.locales') as $locale)
            <div class="form-group">
                <label for="exampleInputEmail1">Name ({{ __('locale.' . $locale)}})</label>
                <input type="text" name="name:{{$locale}}" value="{{$data->translate($locale)->name}}"  class="form-control" id="exampleInputEmail1" placeholder="Enter Store Name" data-validation="required">
            </div>
        @endforeach
        <div class="form-group">
            <label>Store</label>
            <select class="form-control" name="stores_types_id">
                <option>Choose</option>
                @foreach($stores as $store)
                    <option value="{{$store->id}}" {{$store?->id == $data?->store_id ? 'selected' : ''}}>{{$store->name}}</option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image </label>
            </div>
            <div class="form-group">
                <img src="{{asset('')}}{{$data->image}}" width="150px" height="150px">
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image </label>
            <input type="file" name="image" class="form-control" id="exampleInputEmail1" data-validation="required">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnAdd" class="btn btn-primary">Save</button>
    </div>
</form>
<script>

    $(document).ready(function ()
    {
        $('#CategoryFormEdit').on('submit',function (e)
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
                        toastr.success(response.success);
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
