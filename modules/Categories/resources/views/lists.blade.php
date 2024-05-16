@extends('layout.backend')
@section('content')
    <p><a href="{{ route('admin.categories.create') }}" class = "btn btn-primary">Thêm mới</a></p>
    @if (session('msgSuccess'))
        <div class="alert alert-success">
            {{ session('msgSuccess') }}
        </div>
    @endif

    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Link</th>
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
                autoWidth: false,
                processing: true,
                serverSide: true,
                pageLength: 2,
                ajax: '{{ route('admin.categories.data') }}',
                "columns": [{
                        data: 'name'
                    },
                    {
                        data: 'link',
                        searchable: false,
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: "edit",
                        searchable: false,
                    },
                    {
                        data: 'delete',
                        searchable: false,
                    }
                ]
            });
        });
    </script>
@endsection
