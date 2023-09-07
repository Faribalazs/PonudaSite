@extends('layouts.admin')

@section('page-title')
    {{ __('Pozicija') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <button class="add-new-btn mt-3" onclick="insertSwall()">Insert new pozicija</button>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pozicija title</th>
                <th scope="col">Pozicija description</th>
                <th scope="col">Pozicija unit</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pozicija as $poz)
                <tr>
                    <td>{{$poz->id}}</td>
                    <td>{{$poz->title}}</td>
                    <td>{{$poz->description}}</td>
                    <td>{{$poz->unit->name}}</td>
                    <td onclick="editSwall('{{ $poz->id }}', '{{ $poz->title }}', '{{ $poz->description }}', '{{ $poz->unit->id_unit }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                    <td onclick="deleteSwall('{{ $poz->id }}', '{{ $poz->title }}')">
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
            title: 'Insert new pozicija',
            html: 
                '<form method="POST" id="formnew" action="{{ route('admin.insert.pozicija') }}">' +
                '@csrf' +
                '<label for="subcategory_options">Subcategory:</label>' +
                '<select name="subcategory_options" class="mt-3 form-control">' +
                    @foreach ($subcategories as $subcategory)
                        '<option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>'+
                    @endforeach
                '</select>' +
                '<label for="new_title">Title pozicija:</label>' +
                '<input class="mt-3 swal-input" type="text" name="new_title"/>' +
                '<label for="new_description">Description pozicija:</label>' +
                '<textarea class="mt-3 swal-input" rows="4" cols="50" type="text" name="new_description"></textarea>'+
                '<label for="unit_options">Unit:</label>' +
                '<select name="unit_options" class="mt-3 form-control">' +
                    @foreach ($units as $unit)
                        '<option value="{{ $unit->id_unit }}">{{ $unit->name }}</option>'+
                    @endforeach
                '</select>' +
                '<button type="submit" class="add-new-btn mt-3">Insert</button>' +
                '</form>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
        function editSwall(id, title, description, unit) {
            Swal.fire({
            title: 'Edit pozicija',
            html: 
                '<form method="POST" id="formDone" action="{{ route('admin.edit.pozicija') }}">' +
                '@csrf' +
                '@method("put")' +
                '<label for="title">Title pozicija:</label>' +
                '<input class="mt-3 swal-input" type="text" name="title" value="'+title+'"/>' +
                '<label for="description" class="mt-3">Description:</label>' +
                '<textarea class="mt-3 swal-input" rows="4" cols="50" type="text" name="description">' +description + '</textarea>' +
                '<label for="unit">Unit:</label>' +
                '<select name="unit" class="mt-3 form-control">' +
                    @foreach ($units as $unit)
                        '<option value="{{ $unit->id_unit }}"' + (unit == {{ $unit->id_unit }} ? 'selected' : '') + '>{{ $unit->name }}</option>'+
                    @endforeach
                '</select>' +
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
                title: 'Would you like to delete pozicija '+name+'?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formDelete" action="{{ route('admin.delete.pozicija') }}">' +
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

