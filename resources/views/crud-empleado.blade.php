<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/831b505106.js" crossorigin="anonymous"></script>

    <script src="js/createValidation.js"></script>
    <script src="js/updateValidation.js"></script>

    <link rel="icon" href="images/vida_digital_logo.png">
    
    <title>Crud Empleados</title>
</head>

<body style="background-image: url(images/wallpaper_blue_degrade.jpg)">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div>
            <form action="/logout" method="POST">
                @csrf
                <a href="#" class="btn btn-warning btn-sa fa-solid fa-right-from-bracket"
                    onclick="this.closest('form').submit()">Logout</a>
            </form>
        </div>
        <div class="d-flex justify-content-center col-md-3 px-0">
            <a href="https://vidadigital.com.ar/">
                <img class="img-fluid p-1" src="images/vida_digital.png" style="border-radius:10px">
            </a>
        </div>
        <div>
            {{-- Lugar donde los mensajes de éxito o de fallo aparecerán --}}
            @if (session('exito'))
                <div class="alert alert-success">{{ session('exito') }}</div>
            @endif

            @if (session('fallo'))
                <div class="alert alert-danger">{{ session('fallo') }}</div>
            @endif
        </div>
    </div>

    {{-- Cuerpo de la tabla --}}
    <div class=" table-responsive p-3">

        <div>
            <div>
                <a href="{{ route('vidadigital_challenge.readEmpresa') }}" class="btn btn-info btn-sm">Empresas</a>
                <a href="{{ route('vidadigital_challenge.readSucursal') }}" class="btn btn-info btn-sm">Sucursales</a>
                <a class="btn btn-primary btn-sm">Empleados</a>

                <!-- Botón agregar -->
                <button class="btn btn-success btn-sm" style="float:right" data-bs-toggle="modal"
                    data-bs-target="#modalRegistrar">Añadir Empleado</button>
            </div>
        </div>

        <!-- Este modal sirve de registro de nuevas filas a la base de datos -->
        <div class="modal fade" id="modalRegistrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Este formulario me permite añadir los campos de las filas --}}
                        <!-- Acá indico al formulario la ruta hacia mi función create.
                        Tuve que especificar el tipo de método de envío POST -->
                        <form action="{{ route('vidadigital_challenge.createEmpleado') }}" method="POST"
                            class="create-needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" maxlength="50" name="txtNombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" maxlength="50" name="txtApellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" maxlength="8" name="txtDNI" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Empresa a la que pertenece:</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="txtEmpresa" required>
                                    <option selected disabled value="">-- Elija una empresa --</option>
                                    @foreach ($lista_empresa as $item1)
                                        <option value="{{ $item1->cuit }}">{{ $item1->cuit . ' - ' . $item1->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> N° de Sucursal</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="txtN_Sucursal" required>
                                    <option selected>-- Sin asignar --</option>
                                    @foreach ($lista_sucursal as $item2)
                                        <option value="{{ $item2->n_sucursal }}">{{ $item2->n_sucursal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" maxlength="50" name="txtDireccion" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" maxlength="50" name="txtCorreo" required>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal"
                                    value="Cerrar">
                                <button type="submit" onclick="validateData()"
                                    class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white" style="--bs-bg-opacity: .5;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">DNI</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">EMPRESA</th>
                    <th scope="col">SUCURSAL</th>
                    <th scope="col">DIRECCIÓN</th>
                    <th scope="col">CORREO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- Este foreach me trae los datos de Empresa --}}
                @foreach ($datos as $item)
                    <!-- Este modal sirve para eliminar los datos de una fila -->
                    <!-- Nótese que debí especificar la variable de la PK para que el formulario utlice los datos
                            correctos para la eliminación -->
                    <div class="modal fade" id="modalEliminar{{ $item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Empleado</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Está a punto de eliminar este Empleado. ¡Esta acción es irreversible!<br><br>
                                    ¿Está seguro que desea eliminarlo?
                                </div>
                                <!-- Acá especifico la ruta donde se encuentra mi función delete.
                                            También envío la variable que contiene la PK del campo -->
                                <form action="{{ route('vidadigital_challenge.deleteEmpleado', $item->id) }}">
                                    @csrf
                                    <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal"
                                            class="btn btn-primary">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <tr style="background-color: beige">
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->dni }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->apellido }}</td>
                        <td>{{ $item->empresa }}</td>
                        <td>{{ $item->n_sucursal_pertenece }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->correo }}</td>
                        <td style="text-align: center">
                            {{-- Botón MODIFICAR --}}
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#modalModificar{{ $item->id }}"
                                class="btn btn-warning btn-sa "><i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{-- Botón ELIMINAR --}}
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#modalEliminar{{ $item->id }}" class="btn btn-danger btn-sa "><i
                                    class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>

                        <!-- Este modal sirve para modificar los datos de una fila -->
                        <!-- Nótese que debí especificar la variable para que el formulario me mueste los datos
                        de la fila correcta -->
                        <div class="modal fade" id="modalModificar{{ $item->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar Datos</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- Este formulario me permite editar los campos de las filas. 
                                            Tuve que especificar el tipo de método de envío POST. --}}
                                        <form action="{{ route('vidadigital_challenge.updateEmpleado') }}"
                                            method="POST" class="update-needs-validation" novalidate>
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="txtID">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" maxlength="50" name="txtNombre"
                                                    value="{{ $item->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" maxlength="50" name="txtApellido"
                                                    value="{{ $item->apellido }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">DNI</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" maxlength="8" name="txtDNI"
                                                    value="{{ $item->dni }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Empresa a la que
                                                    pertenece:</label>
                                                <select id="companyOption" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example" name="txtEmpresa" required>
                                                    <option value="{{ $item->cuit_empresa }}" selected>
                                                        {{ $item->cuit_empresa . ' - ' . $item->empresa }}</option>
                                                    @foreach ($lista_empresa as $item1)
                                                        <option value="{{ $item1->cuit }}">
                                                            {{ $item1->cuit . ' - ' . $item1->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label"> N° de
                                                    Sucursal</label>
                                                <select class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example" name="txtN_Sucursal"
                                                    required>
                                                    <option value="{{ $item->n_sucursal_pertenece }}" selected>
                                                        {{ $item->n_sucursal_pertenece }}</option>
                                                    @foreach ($lista_sucursal as $item2)
                                                        <option value="{{ $item2->n_sucursal }}">
                                                            {{ $item2->n_sucursal }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" maxlength="50"
                                                    value="{{ $item->direccion }}" name="txtDireccion" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" maxlength="50"
                                                    value="{{ $item->correo }}" name="txtCorreo" required>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal" value="Cerrar">
                                                <button type="submit" onclick="updateValidateData()"
                                                    class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
