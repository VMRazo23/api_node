<?php
require_once 'Curl.php';
$url = Curl::api().'employes/';
$method= 'GET';
$fields = array();
$fields = json_encode($fields);
$resp = Curl::request($url,$method,$fields);

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Pruebas</title>
</head>
<body>
    <div class="modal" tabindex="-1" id="modalEditar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-block">
                    <input type="hidden" id="id_employee">
                    <label for="nombre">Editar nombre</label>
                    <input type="text" id="nombre" class="form-control">
                    <label for="salario">Editar salario</label>
                    <input type="text" id="salario" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Empleados</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($resp as $key => $value): ?>
                <tr>
                    <td><?=$value->id?></td>
                    <td><?=$value->name?></td>
                    <td><?=$value->salary?></td>
                    <td><input type="button" class="btn btn-danger" value="Eliminar" onclick="eliminar('<?=$value->id?>')"></td>
                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar" onclick="editar('<?=$value->id?>')">Editar</button></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="w-50">
            <input type="text" placeholder="Nombre" class="form-control mb-2" id="nombre_nuevo">
            <input type="text" placeholder="Salario" class="form-control" id="salario_nuevo">
            <input type="button" class="btn btn-success mt-2" value="Enviar" id="btn">
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    let btn= document.getElementById('btn')
    btn.addEventListener('click', () => {
        let nombre = $('#nombre_nuevo').val();
        let salario = $('#salario_nuevo').val();
        let event = "createEmployer"
        let url = "controller.php"; // URL a la cual enviar los datos
        let datos = {name:nombre,salary:salario,event:event}
        enviarDatos(datos, url); // Ejecutar cuando se quiera enviar los datos
    })
    function enviarDatos(datos, url){
        $.ajax({
            data: datos,
            url: url,
            type: 'post',
            success:  function (response) {
                let result = JSON.parse(response)
                if(result.status === 200) {
                    alert('Usuario registrado exitosamente')
                }
                console.log(result); // Imprimir respuesta del archivo

            },
            error: function (error) {
                console.log(error); // Imprimir respuesta de error
            }
        });
    }

    const eliminar = (id) => {
        let event = "deleteEmploye";
        $.ajax({
            data: {id,event},
            url: 'controller.php',
            type: 'post',
            success:  function (response) {
                let result = JSON.parse(response)
                if(result.status === 200) {
                    alert('Usuario eliminado exitosamente')
                }
                console.log(result); // Imprimir respuesta del archivo

            },
            error: function (error) {
                console.log(error); // Imprimir respuesta de error
            }
        });
    }

    const editar = (id) => {
        let event = "getEmploye";
        $.ajax({
            data: {id,event},
            url: 'controller.php',
            type: 'post',
            success:  function (response) {
                let result = JSON.parse(response)
                if(result.status === 200) {
                    $('#nombre').val(result.data['name']);
                    $('#salario').val(result.data['salary'])
                     $('#id_employee').val(result.data['id']);
                    console.log(result.data['id']);
                }
            },
            error: function (error) {
                console.log(error); // Imprimir respuesta de error
            }
        });
    }

    const update = () => {
        let event = "updateEmployee";
        let id = $('#id_employee').val();
        let salario = $('#salario').val();
        let nombre = $('#nombre').val();

        console.log(id, salario, nombre)

        $.ajax({
            data: {id,event,salario,nombre},
            url: 'controller.php',
            type: 'post',
            success:  function (response) {
                let result = JSON.parse(response)
                if(result.status === 200) {
                    $('#modalEditar').modal('hide');
                    console.log(result.data);
                }
            },
            error: function (error) {
                console.log(error); // Imprimir respuesta de error
            }
        });
    }

</script>
</html>
