@extends('frontend.Layout.app')
@section('main-content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Añadir Usuarios
</button>
<div class="card text-left">
  
  <div class="card-body">
    
 
    <table id="users" class="table table-striped" >
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
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir usuarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border border-secondary" id="apellidos">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border border-secondary" id="nombre">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="codigo" class="col-sm-2 col-form-label">Código oficial</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border border-secondary" id="codigo">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="codigo" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control border border-secondary" id="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-2 col-form-label">Número de teléfono</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control border border-secondary" id="phone">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="imagen" class="col-sm-2 form-label">Añadir imagen</label>
                    <div class="col-sm-9">
                        <input class="form-control border border-secondary" id="imagen" type="file">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control border border-secondary" id="password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Perfil</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-lg mb-3 border border-secondary" aria-label="form-select-lg example">
                            <option value="1">Estudiante</option>
                            <option value="2">Profesor</option>
                        </select>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Enviar un correo al nuevo usuario</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                            Si
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                            No
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
            $('#users').DataTable( {
                responsive: true,
                autoWidth:false
            } );
        });
    </script>
@endsection