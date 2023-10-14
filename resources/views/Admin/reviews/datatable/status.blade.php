@if($status == 1)
    <button id="btnStatus" class="btn btn-warning" data-id="{{$id}}">Not Active</button>
@else
    <button id="btnEdit" class="btn btn-success" data-id=" {{$id}} ">Active</button>
@endif
<script>
    $("#btnStatus").on('click', function () {
        {{--$.ajax({--}}
        {{--    url: "{{ route('coupons.create')}}",--}}
        {{--    success: function (response) {--}}
        {{--        $('.modal-body').html(response.createForm);--}}
        {{--        $('#Modal').modal('show');--}}
        {{--        $('#ModalLabel').text('Add New Coupon');--}}
        {{--    }--}}
        {{--});--}}
    });
</script>
