@extends('frontend.Layout.app')
@section('main-content')
    <table id="users" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('custom-scripts')
    <script>
      let table = new DataTable('#users')

        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>
@endpush
