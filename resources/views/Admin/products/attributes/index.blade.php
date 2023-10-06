<h3 style="text-align: center">Sizes of Product</h3>
<div style="display: flex; justify-content: center;">
    <table id="sizes" class="table" style="width: 75%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sizes as $size)
            <tr>
                <td>{{$size->name}}</td>
                <td>
                    <button id="btnEdit" class="btn btn-warning" data-id=" {{$size->id}} ">Edit</button>
                    <button id="btnDelete" class="btn btn-danger" data-id=" {{$size->id}}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<h3 style="text-align: center">Colors of Product</h3>
<div style="display: flex; justify-content: center;">
    <table id="colors" class="table" style="width: 75%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($colors as $color)
            <tr>
                <td>{{$color->name}}</td>
                <td>
                    <button id="btnEdit" class="btn btn-warning" data-id="{{$color->id}} ">Edit</button>
                    <button id="btnDelete" class="btn btn-danger" data-id=" {{$color->id}} ">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $('#sizes').on('click', '#btnEdit', function () {
        var sizeId = $(this).data('id');
        var url = "{{route('sizes.edit',':sizeId')}}"
        url = url.replace(':sizeId', sizeId);
        $.ajax({
            url: url,
            success: function (response) {
                $('.modal-body').html(response.html);
                $('#Modal').modal('show');
                $('#ModalLabel').text('Edit Attribute');
            }
        });
    });
    $('#colors').on('click', '#btnEdit', function () {
        var colorId = $(this).data('id');
        var url = "{{route('colors.edit',':colorId')}}"
        url = url.replace(':colorId', colorId);
        $.ajax({
            url: url,
            success: function (response) {
                $('.modal-body').html(response.html);
                $('#Modal').modal('show');
                $('#ModalLabel').text('Edit Attribute');
            }
        });
    });

    $('#sizes').on('click', '#btnDelete', function () {
        var sizeId = $(this).data('id');
        var url = "{{route('sizes.destroy',':sizeId')}}"
        url = url.replace(':sizeId', sizeId);
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
    $('#colors').on('click', '#btnDelete', function () {
        var colorId = $(this).data('id');
        var url = "{{route('colors.destroy',':colorId')}}"
        url = url.replace(':colorId', colorId);
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
