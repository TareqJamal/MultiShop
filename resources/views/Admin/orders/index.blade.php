@extends('Admin.layout.index')
@section('title')
    Orders
@endsection
@section('content')
    <div class="card-body">
        <table id="orders" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Is Paid</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Is Paid</th>
                <th>Payment Method</th>
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
            myTable = $('#orders').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ordersDashboard.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'totalPrice', name: 'totalPrice'},
                    {data: 'status', name: 'status'},
                    {data: 'is_paid', name: 'is_paid'},
                    {data: 'paymentMethod', name: 'paymentMethod'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
        $('#orders').on('click','#btnView',function() {
            var orderId = $(this).data('id');
            var url = "{{route('ordersDashboard.show',':orderId')}}"
            url = url.replace(':orderId',orderId);
            $.ajax({
                url: url,
                type: 'Get',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                },
                success: function (response) {
                    $('.modal-body').html(response.html);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Details of Order');
                }
            });
        });
    </script>
@endsection
