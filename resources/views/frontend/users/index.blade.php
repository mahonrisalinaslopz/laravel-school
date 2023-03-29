@extends('frontend.Layout.app')
@section('main-content')
    <div class="col-12 d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-11">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Añadir Usuarios
            </button>
        </div>
        <div class="card text-left col-md-11">
            <div class="card-body">
                <table id="users" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><span class="material-icons">mode_edit</span></button> 
                               
                                  <button type="submit" class="btn btn-danger mx-3" data-bs-toggle="modal"  data-bs-target="#deleteModal"><span class="material-icons">delete_forever</span></button>
                               
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
              </div>      
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Elimnar registro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Deseas eliminar la información?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Eliminar</button>
          </div>
        </div>
      </div>
    </div>             
                      
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
@endsection
  

