@extends('layout.backend')
@section('content')
    <p><a href="{{ route('admin.courses.create') }}" class = "btn btn-primary">Thêm mới</a></p>
    @if (session('msgSuccess'))
        <div class="alert alert-success">
            {{ session('msgSuccess') }}
        </div>
    @endif

    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>

    </table>
    @include('parts.backend.delete')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.courses.data') }}',
                "columns": [{
                        data: 'name'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'status'
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
