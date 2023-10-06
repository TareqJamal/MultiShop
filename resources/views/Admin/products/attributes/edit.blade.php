<form role="form" id="attributeForm" data-action="{{isset($size) ? route('sizes.update',$size->id) : route('colors.update',$color->id)}}" method="post"
      enctype=multipart/form-data>
    @method('Put')
    @csrf
    <div class="card-body">
        @if(isset($size))
            @if($size->type == \App\Enum\AttributesTypes::sizeClothes->value)
                <div class="form-group">
                    <label>
                        Product Size
                    </label>
                    <select class="form-control" name="name" style="width:100%">
                        <option value="s" {{$size->name == 's' ? 'selected' : ''}}>S</option>
                        <option value="m" {{$size->name == 'm' ? 'selected' : ''}}>M</option>
                        <option value="l" {{$size->name == 'l' ? 'selected' : ''}}>L</option>
                        <option value="xl" {{$size->name == 'xl' ? 'selected' : ''}}>XL</option>
                        <option value="xxl"{{$size->name == 'xxl' ? 'selected' : ''}}>XXL</option>
                    </select>
                </div>
            @else
                <div class="form-group">
                    <label>
                        Product Size
                    </label>
                    <select class="form-control" name="name"
                            style="width:100%">
                        <option value="28" {{$size->name == '28' ? 'selected' : ''}}>28</option>
                        <option value="30" {{$size->name == '30' ? 'selected' : ''}}>30</option>
                        <option value="32" {{$size->name == '32' ? 'selected' : ''}}>32</option>
                        <option value="34" {{$size->name == '34' ? 'selected' : ''}}>34</option>
                        <option value="36" {{$size->name == '36' ? 'selected' : ''}}>36</option>
                        <option value="38" {{$size->name == '38' ? 'selected' : ''}}>38</option>
                    </select>
                </div>
            @endif
        @elseif(isset($color))
            <div class="form-group">
                <label>
                    Product Color
                </label>
                <select class="form-control" name="name" style="width:100%">
                    <option value="red" {{$color->name == 'red' ? 'selected' : ''}}>Red</option>
                    <option value="black" {{$color->name == 'black' ? 'selected' : ''}}>Black</option>
                    <option value="white" {{$color->name == 'white' ? 'selected' : ''}}>White</option>
                    <option value="blue"{{$color->name == 'blue' ? 'selected' : ''}}>Blue</option>
                    <option value="green" {{$color->name == 'green' ? 'selected' : ''}}>Green</option>
                    <option value="yellow" {{$color->name == 'yellow' ? 'selected' : ''}}>Yellow</option>
                </select>
            </div>

        @endif
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btnAdd" class="btn btn-primary">Edit</button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#attributeForm').on('submit', function (e) {
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

</form>
