@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Numer telefonu</th>
            <th scope="col">Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">
                        X
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
@section('javascript')
  alert('dupa')
  const deleteUrl = "{{ url('users') }}/"
@endsection
@section('js-files')
    <script>
        $(function() {
            $('.delete').click(function() {
                //alert('Coś')
                //Swal.fire('Hello world!')
                Swal.fire({
                    title: 'confirmDelete',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Tak',
                    cancelButtonText: 'Nie'
                }).then((result) => {
                    if (result.value) {
                        alert('usuwaj ' + result.value)
                        $.ajax({
                            method: "DELETE",
                            url: deleteUrl + $(this).data("id")
                        })
                            .done(function (data) {
                                window.location.reload();
                            })
                            .fail(function (data) {
                                Swal.fire('Oops...', data.responseJSON.message, data.responseJSON.status);
                            });
                    }
                })
            });
        });
    </script>
     <!--<script src="{{ asset('js/delete.js') }}"></script> -->
@endsection

