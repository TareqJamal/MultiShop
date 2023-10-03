@extends('Admin.layout.index')
@section('title')
    Coupons
@endsection
@section('content')
    <a id="addType" class="btn btn-primary" role="button">Add New Coupon</a>
    <div class="card-body">

        <table id="coupons" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Percentage</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Percentage</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
@section('js')
    <script>
        var myTable;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function () {
            myTable = $('#coupons').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('coupons.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'code', name: 'code'},
                    {data: 'percentage', name: 'percentage'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $("#addType").on('click', function () {
            $.ajax({
                url: "{{ route('coupons.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Coupon');
                }
            });
        });

        $('#coupons').on('click','#btnEdit',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.edit',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Coupon');
                }
            });
        });
        $('#coupons').on('click','#btnStatus',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.show',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                success: function (response) {
                    toastr.success(response.success);
                    myTable.ajax.reload();
                }
            });
        });

        $('#coupons').on('click','#btnDelete',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.destroy',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                },
                success: function (response) {
                    toastr.success(response.success);
                    myTable.ajax.reload();
                }
            });
        });
    </script>
    <script>

    </script>
    <script>

        // Initiate form validation
        $.validate({
            modules: 'date, security'
        });
    </script>
@endsection
