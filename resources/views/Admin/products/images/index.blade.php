<table id="images" class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($images as $image)
    <tr>
        <td><img src="{{asset("")}}{{$image->image}}" width="150px" height="150px"></td>
        <td>
            <button id="btnEdit" class="btn btn-warning" data-id=" {{$image->id}} ">Edit</button>
            <button id="btnDelete" class="btn btn-danger" data-id=" {{$image->id}}">Delete</button>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>
<script>
    $('#images').on('click', '#btnEdit', function () {
        var imageId = $(this).data('id');
        var url = "{{route('images.edit',':imageId')}}"
        url = url.replace(':imageId', imageId);
        $.ajax({
            url: url,
            success: function (response) {
                $('.modal-body').html(response.html);
                $('#Modal').modal('show');
                $('#ModalLabel').text('Edit Image');
            }
        });
    });
    $('#images').on('click', '#btnDelete', function () {
        var imageId = $(this).data('id');
        var url = "{{route('images.destroy',':imageId')}}"
        url = url.replace(':imageId', imageId);
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
            },
            success: function (response) {
                toastr.success(response.success);
                $('#Modal').modal('hide');
            }
        });
    });
</script>
