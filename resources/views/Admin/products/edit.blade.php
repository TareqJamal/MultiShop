
<form role="form" id="productForm" data-action="{{route('products.update',$product->id)}}" method="post"
      enctype=multipart/form-data>
    @method('Put')
    @csrf
    <div class="card-body">
        @foreach(config('translatable.locales') as $locale)
            <div class="form-group">
                <label for="exampleInputEmail1">Name ({{ __('locale.' . $locale)}})</label>
                <input type="text" name="name:{{$locale}}" value="{{$product->translate($locale)->name}}"
                       class="form-control" id="exampleInputEmail1"
                       placeholder="Enter Product Name" data-validation="required">
            </div>
        @endforeach
        @foreach(config('translatable.locales') as $locale)
            <div class="form-group">
                <label for="exampleInputEmail1">Description ({{ __('locale.' . $locale)}})</label>
                <textarea type="text" name="description:{{$locale}}" class="form-control" id="exampleInputEmail1"
                          placeholder="Enter Product Description"
                          data-validation="required">{{$product->translate($locale)->description}}</textarea>
            </div>
        @endforeach
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" value="{{$product->price}}" class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Discount %</label>
            <input type="number" name="discount" value="{{$product->discount}}" class="form-control"
                   id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control"
                   id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
        </div>
        <div class="form-group">
            <img src="{{asset('')}}{{$product->image}}" width="150px" height="150px">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
        <div class="form-group">
            <label>
                Category
            </label>
            <select class="form-control" name="category_id" style="width:100%">
                <option value="">Choose</option>
                @foreach($categories as $category)
                    <option
                        value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>
                Store
            </label>
            <select class="form-control" name="store_id" style="width:100%">
                <option value="">Choose</option>
                @foreach($stores as $store)
                    @if($store->storageCapacity != 0)
                        <option
                            value="{{$store->id}}" {{$store->id == $product->store_id ? 'selected' : ''}}>{{$store->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnAdd" class="btn btn-primary">Save</button>
    </div>
</form>
<script>

    $(document).ready(function () {
        $('#productForm').on('submit', function (e) {
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
                    if(response.success) {
                        toastr.success(response.success);
                        $('#Modal').modal('hide');
                        myTable.ajax.reload();
                    }
                    if(response.error)
                    {
                        toastr.error(response.error);
                    }
                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
        $(".js-example-responsive").select2({
            width: 'resolve',
            color: 'black'// need to override the changed default
        });
    });
</script>
