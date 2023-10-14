@extends('Admin.layout.index')
@section('title')
    Customers
@endsection
@section('content')
    <div class="card-body">
        <table id="customers" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Image</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Image</th>
                <th>Date</th>
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
            myTable = $('#customers').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customersDashboard.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'Phone'},
                    {data: 'address', name: 'Address'},
                    {data: 'image', name: 'image'},
                    {data: 'created_at', name: 'created_at'},
                ]
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
