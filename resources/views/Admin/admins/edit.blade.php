<form role="form" id="AdminFormEdit" data-action="{{route('admins.update',$data->id)}}" method="post" enctype= multipart/form-data>
    @method('Put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" value="{{$data->name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" value="{{$data->email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="text" name="phone" value="{{$data->phone}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
        </div>
        <div class="form-group">

            <img src="{{asset('')}}{{$data->image}}" width="150px" height="150px">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Change Image</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
            </div>
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
        $('#AdminFormEdit').on('submit',function (e)
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
                        toastr.success('Admin Updated Successfully');
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
