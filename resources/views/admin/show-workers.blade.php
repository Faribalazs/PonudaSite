@extends('layouts.admin')

@section('page-title')
    {{ __('Workers') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ime</th>
                <th scope="col">Email</th>
                <th scope="col">Kreirane ponude</th>
                <th scope="col">Status</th>
                <th scope="col">Ban</th>
                <th scope="col">Unban</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->ponuda_counter-1}}</td>
                    <td>@if($user->status == 1) Aktivan @else Zabranjen @endif</td>
                    <td onclick="BanSwall('{{ $user->id }}', '{{ $user->name }}')">
                        <div class="d-flex justify-content-center">
                            <button class="modositas-btn mr-1">
                                <i class="ri-edit-2-line"></i>
                            </button>
                        </div>
                    </td>
                    <td onclick="unBanSwall('{{ $user->id }}', '{{ $user->name }}')">
                        <button class="torles-btn ml-1">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <script>
        function unBanSwall(id, name) {
            Swal.fire({
                title: 'Da li želite da opozovete zabranu '+name+'?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formUnban" action="{{ route('admin.unban.worker') }}">' +
                    '@csrf' +
                    '@method("put")' +
                    '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                    '<button type="submit" class="add-new-btn mt-3">Unban</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
        function BanSwall(id, name) {
            Swal.fire({
                title: 'Želite li zabraniti '+name+'?',
                icon: 'question',
                html: 
                    '<form method="POST" id="formBan" action="{{ route('admin.ban.worker') }}">' +
                    '@csrf' +
                    '@method("put")' +
                    '<input class="mt-3 swal-input" hidden type="text" name="id" value="'+id+'"/>' +
                    '<button type="submit" class="add-new-btn mt-3">Ban</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
    </script>
@endsection

