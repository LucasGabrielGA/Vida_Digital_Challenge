<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="js/loginValidation.js"></script>

    <link rel="icon" href="images/vida_digital_logo.png">
    <title>Vida Digital CRUD Challenge</title>
</head>

<body style="overflow:hidden; background-image: url(images/wallpaper_blue_degrade.jpg)" >
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-3 px-0">
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
    <br>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
                </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="{{ route('vidadigital_challenge.verifyCredentials') }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Correo</label>
                        <input type="email" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Introduzca su correo electrónico..." name="email" required />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Contraseña</label>
                        <input type="password" id="form3Example4" class="form-control form-control-lg"
                            placeholder="Introduzca su contraseña..." name="password" required />
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="validateData()">Login</button>
                    </div>
                </form>
                <p class="small fw-bold mt-2 pt-1 mb-0">¿No tiene una cuenta?
                    <a href="" class="link-primary" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrar">Regístrese</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Este modal sirve de registro de usuarios-->
    <div class="modal fade" id="modalRegistrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Este formulario me permite añadir los campos de las filas --}}
                    <!-- Acá indico al formulario la ruta hacia mi función create.
                Tuve que especificar el tipo de método de envío POST -->
                    <form action="{{ route('vidadigital_challenge.registerUser') }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" maxlength="50" name="txtNombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" maxlength="50" name="txtEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" maxlength="50" name="txtPassword" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" onclick="validateData()" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
