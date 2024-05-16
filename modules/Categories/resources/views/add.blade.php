@extends('layout.backend')
@section('content')
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control title {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        id="name" name="name" placeholder="Nhập tên..." value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control slug {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                        id="slug" name="slug" placeholder="Slug..." value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="parent_id">Cha</label>
                    <select name="parent_id" id="parent_id"
                        class="form-select {{ $errors->has('parent_id') ? 'is-invalid' : '' }}">
                        <option value="0">Không</option>
                        {{ getCategories($categories, old('parent_id')) }}
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    @endsection
