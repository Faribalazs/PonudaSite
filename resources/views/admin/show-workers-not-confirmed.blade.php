@extends('layouts.admin')

@section('page-title')
    {{ __('Not Activated Coaches') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Activate</th>
                <th scope="col">Dismiss</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td onclick="activateSwall('{{ $user->id }}', '{{ $user->name }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                    <td onclick="dismissSwall('{{ $user->id }}', '{{ $user->name }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function activateSwall(id, name) {
            Swal.fire({
                title: 'Would you like to activate '+name+'\'s coach account?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formDelete" action="{{ route('admin.activate.worker') }}">' +
                    '@csrf' +
                    '@method("put")' +
                    '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                    '<button type="submit" class="add-new-btn mt-3">Activate</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
        function dismissSwall(id, name) {
            Swal.fire({
                title: 'Would you like to dismiss '+name+'\'s coach account?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formDelete" action="{{ route('admin.dismiss.worker') }}">' +
                    '@csrf' +
                    '@method("put")' +
                    '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                    '<button type="submit" class="add-new-btn mt-3">Dismiss</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
    </script>
@endsection

