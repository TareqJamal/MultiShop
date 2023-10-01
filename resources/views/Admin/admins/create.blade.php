<form role="form" id="AdminForm" data-action="{{route('admins.store')}}" method="post" enctype= multipart/form-data>
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword1" placeholder="Password" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Image</label>
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
                    if(response.message)
                    {
                        toastr.error(response.message)
                    }
                    if(response.success)
                    {
                        toastr.success(response.success)
                        $('#Modal').modal('hide');
                        myTable.ajax.reload();
                    }
                },
                error: function(response) {
                     toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
