@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Category
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary float-right">
                    Go Back
                </a>
            </h3>     
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" method="post" id="category-form">
                @csrf 
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label for="image">Photo</label>
                    <br>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Default --</option>
                        @foreach($categories as $id => $categoryName)
                            <option value="{{ $id }}">{{ $categoryName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style-alt')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('script-alt')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

@endpush
