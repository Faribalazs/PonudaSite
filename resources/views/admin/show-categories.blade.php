@extends('layouts.admin')

@section('page-title')
    {{ __('Categories') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <button class="add-new-btn mt-3" onclick="insertSwall()">Insert new category</button>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td onclick="editSwall('{{ $category->id }}', '{{ $category->name }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                    <td onclick="deleteSwall('{{ $category->id }}', '{{ $category->name }}')">
                        <button class="torles-btn ml-1">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function insertSwall() {
            Swal.fire({
            title: 'Insert new category',
            html: 
                '<form method="POST" id="formnew" action="{{ route('admin.insert.category') }}">' +
                '@csrf' +
                '<label for="new_category_name">Category name:</label>' +
                '<input class="mt-3 swal-input" type="text" name="new_category_name"/>' +
                '<button type="submit" class="add-new-btn mt-3">Insert</button>' +
                '</form>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
        function editSwall(id, name) {
            Swal.fire({
            title: 'Edit category',
            html: 
                '<form method="POST" id="formDone" action="{{ route('admin.edit.category') }}">' +
                '@csrf' +
                '@method("put")' +
                '<label for="category_name">Category name:</label>' +
                '<input class="mt-3 swal-input" type="text" name="category_name" value="'+name+'"/>' +
                '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                '<button type="submit" class="add-new-btn mt-3">Edit</button>' +
                '</form>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
        function deleteSwall(id, name) {
            Swal.fire({
                title: 'Would you like to delete category '+name+'?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formDelete" action="{{ route('admin.delete.category') }}">' +
                    '@csrf' +
                    '@method("delete")' +
                    '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                    '<button type="submit" class="add-new-btn mt-3">Delete</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
    </script>
@endsection

