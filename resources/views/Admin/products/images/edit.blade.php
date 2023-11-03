<form role="form" id="imageEditForm" data-action="{{route('images.update',$image->id)}}" method="post"
      enctype=multipart/form-data>
    @method('Put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
        </div>
        <div class="form-group">
          <img src="{{asset('')}}{{$image->image}}" width="75px" height="150px">
        </div>
        <div class="form-group">
            <input type="file" name="image"  class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btnAdd" class="btn btn-primary">Edit</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#imageEditForm').on('submit', function (e) {
            var url = $(this).attr('data-action');
            e.preventDefault();
            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    toastr.success(response.success);
                    $('#Modal').modal('hide');
                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
