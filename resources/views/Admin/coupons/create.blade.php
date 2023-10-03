<form role="form" id="couponForm" data-action="{{route('coupons.store')}}" method="post" enctype= multipart/form-data>
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Code </label>
            <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Code" data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Percentage(%)</label>
            <input type="number" name="percentage" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Percentage" data-validation="required">
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
        $('#couponForm').on('submit',function (e)
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
