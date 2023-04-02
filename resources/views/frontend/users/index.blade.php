@extends('frontend.Layout.app')
@section('main-content')
    <div class="col-12 d-flex flex-column justify-content-center align-items-center py-4" style="min-height: 100vh">
        @if (session('error_form_add'))
            <div class="alert alert-danger col-11 text-white" role="alert">
                <span>{{ session('error_form_add') }}</span>
                <ul class="m-0">
                    @error('apellidos')
                        <li>Apellidos</li>
                    @enderror
                    @error('nombre')
                        <li>Nombre</li>
                    @enderror
                    @error('codigo')
                        <li>Código Oficial</li>
                    @enderror
                    @error('email')
                        <li>Email</li>
                    @enderror
                    @error('phone')
                        <li>Número de teléfono</li>
                    @enderror
                    @error('password')
                        <li>Contraseña</li>
                    @enderror
                </ul>
            </div>
        @endif

        @if (session('success_form_add'))
            <div class="alert alert-success col-11 text-white" role="alert">
                <span>{{ session('success_form_add') }}</span>
            </div>
        @endif

        @if (session('success_form_delete'))
            <div class="alert alert-danger col-11 text-white" role="alert">
                <span>{{ session('success_form_delete') }}</span>
            </div>
        @endif

        <div class="col-md-11">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Añadir Usuarios
            </button>
        </div>
        <div class="card text-left col-md-11">
            <div class="card-body">
                <table id="users" class="table table-striped col-12 align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->users->email }}</td>
                                <td>
                                    @switch($user)
                                        @case($user->users->hasRole('admin'))
                                            <span class="btn m-0 rol">Admin</span>
                                        @break

                                        @case($user->users->hasRole('teacher'))
                                            <span class="btn m-0 rol">Maestro</span>
                                        @break

                                        @case($user->users->hasRole('student'))
                                            <span class="btn m-0 rol">Alumno</span>
                                        @break

                                        @default
                                            <span class="btn m-0 rol">Sin rol</span>
                                    @endswitch
                                </td>
                                <td>
                                    {{-- <button type="button" class="btn btn-warning mb-0" data-bs-toggle="modal"
                                        data-bs-target="#editModal"><span class="material-icons">mode_edit</span></button> --}}

                                    <button type="submit" class="btn btn-danger mb-0 mx-3" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal_{{ $user->users->id }}"><span
                                            class="material-icons">delete_forever</span></button>
                                    <form action="{{ route('users.destroy', $user->users->id) }}" method="post" hidden
                                        id="delete_form_{{ $user->users->id }}">
                                        @csrf
                                        @method('delete')
                                        {{-- <input type="number" hidden value="{{ $user->users->id }}"> --}}
                                    </form>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal_{{ $user->users->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Elimnar registro</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Deseas eliminar este registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>

                                                    <button type="submit" form="delete_form_{{ $user->users->id }}"
                                                        class="btn btn-primary">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir usuarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-9">
                                <input name="apellidos" required type="text" class="form-control border border-secondary"
                                    id="apellidos">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input name="nombre" required type="text" class="form-control border border-secondary"
                                    id="nombre">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="codigo" class="col-sm-2 col-form-label">Código oficial <small>(Si
                                    aplica)</small></label>
                            <div class="col-sm-9">
                                <input name="codigo" required type="text" class="form-control border border-secondary"
                                    id="codigo">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" required type="email" class="form-control border border-secondary"
                                    id="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Número de teléfono</label>
                            <div class="col-sm-9">
                                <input name="phone" required type="number"
                                    class="form-control border border-secondary" id="phone">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="imagen" class="col-sm-2 form-label">Añadir imagen</label>
                            <div class="col-sm-9">
                                <input name="imagen" class="form-control border border-secondary" id="imagen"
                                    type="file">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-9">
                                <input name="password" required type="password"
                                    class="form-control border border-secondary" id="password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Perfil</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-lg mb-3 border border-secondary" name="rol"
                                    required>
                                    <option value="null" selected disabled>Selecciona un rol:</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-8 pt-0">Enviar un correo al nuevo usuario</legend>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </fieldset> --}}
                        <button type="submit" class="btn btn-primary">Añadir usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-9">
                                <input name="apellidos" type="text" class="form-control border border-secondary"
                                    id="apellidos">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input name="nombre" type="text" class="form-control border border-secondary"
                                    id="nombre">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="codigo" class="col-sm-2 col-form-label">Código oficial</label>
                            <div class="col-sm-9">
                                <input name="codigo" type="text" class="form-control border border-secondary"
                                    id="codigo">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" type="email" class="form-control border border-secondary"
                                    id="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Número de teléfono</label>
                            <div class="col-sm-9">
                                <input name="phone" type="number" class="form-control border border-secondary"
                                    id="phone">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="imagen" class="col-sm-2 form-label">Añadir imagen</label>
                            <div class="col-sm-9">
                                <input name="imagen" class="form-control border border-secondary" id="imagen"
                                    type="file">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control border border-secondary"
                                    id="password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Perfil</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-lg mb-3 border border-secondary">
                                    <option value="null" selected disabled>Selecciona un rol:</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
    <style>
        .rol {
            cursor: default !important;
            background-color: #ffdd57 !important;
        }

        @media screen and (max-width: 768px) {
            #users {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                border-collapse: collapse;
            }
        }
    </style>
@endsection
