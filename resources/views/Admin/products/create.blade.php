<form role="form" class="row" id="productForm" data-action="{{route('products.store')}}" method="post"
      enctype=multipart/form-data>
    @csrf
    <div class="card-body">
        @foreach(config('translatable.locales') as $locale)
            <div class="form-group">
                <label for="exampleInputEmail1">Name ({{ __('locale.' . $locale)}})</label>
                <input type="text" name="name:{{$locale}}" class="form-control" id="exampleInputEmail1"
                       placeholder="Enter Product Name" data-validation="required">
            </div>
        @endforeach
        @foreach(config('translatable.locales') as $locale)
            <div class="form-group">
                <label for="exampleInputEmail1">Description ({{ __('locale.' . $locale)}})</label>
                <textarea type="text" name="description:{{$locale}}" class="form-control" id="exampleInputEmail1"
                          placeholder="Enter Product Description" data-validation="required"></textarea>
            </div>
        @endforeach
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Discount %</label>
            <input type="number" name="discount" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
            <input hidden name="priceAfterDiscount" value="">
        <div class="form-group">
            <label>
                Category
            </label>
            <select class="form-control" name="category_id" style="width:100%">
                <option value="">Choose</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
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
                    <option value="{{$store->id}}">{{$store->name}} | {{$store->storageCapacity}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>
                Product Size (For Clothes)
            </label>
            <select class="form-control js-example-basic-multiple js-example-responsive" name="sizes_clothes[]"
                    multiple="multiple" style="width:100%">
                <option value="s">S</option>
                <option value="m">M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
                <option value="xxl">XXL</option>
            </select>
        </div>
        <div class="form-group">
            <label>
                Product Size (For Shoes)
            </label>
            <select class="form-control js-example-basic-multiple js-example-responsive" name="sizes_shoes[]"
                    multiple="multiple" style="width:100%">
                <option value="28">28</option>
                <option value="30">30</option>
                <option value="32">32</option>
                <option value="34">34</option>
                <option value="36">36</option>
                <option value="38">38</option>
            </select>
        </div>
            <div class="form-group">
                <label>
                    Product Colors
                </label>
                <select class="form-control js-example-basic-multiple js-example-responsive" name="colors[]"
                        multiple="multiple" style="width:100%">
                    <option value="red">Red</option>
                    <option value="black">Black</option>
                    <option value="white">White</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="yellow">Yellow</option>
                </select>
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Addition Images</label>
            <input type="file" name="images[]" multiple class="form-control" id="exampleInputEmail1"
                   data-validation="required">
        </div>
            @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
            <input hidden name="user_id" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->id}}">
            @endif
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btnAdd" class="btn btn-primary">Add</button>
        </div>
    </div>

    <!-- /.card-body -->

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
                        toastr.success(response.success)
                        $('#Modal').modal('hide');
                        myTable.ajax.reload();
                    }
                    if(response.error)
                    {
                        toastr.error(response.error)
                        // $('#Modal').modal('hide');
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
            width: 'resolve' // need to override the changed default
        });
    });
</script>
