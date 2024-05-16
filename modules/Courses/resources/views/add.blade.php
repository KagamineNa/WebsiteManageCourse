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
                    <label for="teacher_id">Giảng viên</label>
                    <select name="teacher_id" id="teacher_id"
                        class="form-select {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Tạ Hoàng An</option>
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="code">Mã khóa học</label>
                    <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="code"
                        name="code" placeholder="Mã khóa học..." value="{{ old('code') }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="price">Giá khóa học</label>
                    <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                        id="price" name="price" placeholder="Giá khóa học..." value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="sale_price">Giá khuyến mãi</label>
                    <input type="text" class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}"
                        id="sale_price" name="sale_price" placeholder="Giá khuyến mãi..." value="{{ old('sale_price') }}">
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="is_document">Tài liệu đính kèm</label>
                    <select name="is_document" id="is_document"
                        class="form-select {{ $errors->has('is_document') ? 'is-invalid' : '' }}">
                        <option value="0" {{ old('is_document') == 0 ? 'selected' : '' }}>Không</option>
                        <option value="1" {{ old('is_document') == 1 ? 'selected' : '' }}>Có</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status"
                        class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Chưa ra mắt</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Đã ra mắt</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Chuyên mục</label>
                    <div class="list-categories">
                        {{ getCategoriesCheckbox($categories, old('categories')) }}
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="detail">Nội dung</label>
                    <textarea name="detail" class= "form-control ckeditor {{ $errors->has('detail') ? 'is-invalid' : '' }}" id="detail"
                        cols="30" rows="10" placeholder="Nội dung...">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="supports">Hỗ trợ</label>
                    <textarea name="supports" class= "form-control {{ $errors->has('supports') ? 'is-invalid' : '' }}" id="supports"
                        cols="30" rows="10" placeholder="Hỗ trợ...">{{ old('supports') }}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-7">
                            <label for="thumbnail">Ảnh đại diện</label>
                            <input type="text"
                                class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" id="thumbnail"
                                name="thumbnail" placeholder="Ảnh đại diện..." value="{{ old('thumbnail') }}">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="thumbnail"
                                data-preview="holder">
                                Thêm ảnh
                            </button>
                        </div>
                        <div class="col-3">
                            <div id="holder" style="margin-top:15px;">
                                @if (old('thumbnail'))
                                    <img src="{{ old('thumbnail') }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>
@endsection

@section('stylesheets')
    <style>
        #holder img {
            max-width: 100%;
            max-height: 100px;
            height: auto;
        }

        .list-categories {
            max-height: 250px;
            overflow: auto;
        }
    </style>
@endsection
