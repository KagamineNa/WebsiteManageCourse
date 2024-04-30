@extends('layout.backend')
@section('content')
    <p><a href="{{ route('admin.user.create') }}" class = "btn btn-primary">Thêm mới</a></p>
    @if (session('msgSuccess'))
        <div class="alert alert-success">
            {{ session('msgSuccess') }}
        </div>
    @endif

    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Thời gian</th>
                <th><a href="#" class = "btn btn-warning">Sửa</a></th>
                <th><a href="#" class = "btn btn-danger">Xóa</a></th>
            </tr>
        </tfoot>
    </table>
    @include('parts.backend.delete')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.user.data') }}',
                "columns": [{
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'group_id'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: "edit"
                    },
                    {
                        data: 'delete'
                    }
                ]
            });
        });
    </script>
@endsection
