@extends('layouts.admin')

@section('page-title')
    {{ __('Subcategories') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <button class="add-new-btn mt-3" onclick="insertSwall()">Insert new subcategory</button>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subcategory Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{$subcategory->id}}</td>
                    <td>{{$subcategory->name}}</td>
                    <td onclick="editSwall('{{ $subcategory->id }}', '{{ $subcategory->name }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                    <td onclick="deleteSwall('{{ $subcategory->id }}', '{{ $subcategory->name }}')">
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
            title: 'Insert new subcategory',
            html: 
                '<form method="POST" id="formnew" action="{{ route('admin.insert.subcategory') }}">' +
                '@csrf' +
                '<label for="category_options">Category:</label>' +
                '<select name="category_options" class="mt-3 form-control">' +
                    @foreach ($categories as $category)
                        '<option value="{{ $category->id }}">{{ $category->name }}</option>'+
                    @endforeach
                '</select>' +
                '<label for="new_subcategory_name">Subcategory name:</label>' +
                '<input class="mt-3 swal-input" type="text" name="new_subcategory_name"/>' +
                '<button type="submit" class="add-new-btn mt-3">Insert</button>' +
                '</form>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
        function editSwall(id, name) {
            Swal.fire({
            title: 'Edit subcategory',
            html: 
                '<form method="POST" id="formDone" action="{{ route('admin.edit.subcategory') }}">' +
                '@csrf' +
                '@method("put")' +
                '<label for="subcategory_name">Subcategory name:</label>' +
                '<input class="mt-3 swal-input" type="text" name="subcategory_name" value="'+name+'"/>' +
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
                title: 'Would you like to delete subcategory '+name+'?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formDelete" action="{{ route('admin.delete.subcategory') }}">' +
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

