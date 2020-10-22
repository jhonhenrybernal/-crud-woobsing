
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Album example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <header>

  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
         <strong>Crud </strong>
      </a>
    </div>
  </div>
</header>
 <div class="alert alert-success alert-dismissible" id="success">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong>Realizado.
  </div>

<main role="main">
  <div class="album py-5 bg-light">
    <div class="container">
       <form>
         <div class="form-row">
            <div class="form-group col-md-4">
            <label for="inputCity">Nombre</label>
            <input type="hidden" class="form-control" id="id">
            <input type="text" class="form-control" id="nombre">
            </div>
            <div class="form-group col-md-4">
            <label for="inputCity">Apellido</label>
            <input type="text" class="form-control" id="apellido">
            </div>

            <div class="form-group col-md-4">
            <label for="inputZip">telefono</label>
            <input type="text" class="form-control" id="telefono">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Correo</label>
            <input type="email" class="form-control" id="correo">
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword4">Direccion</label>
            <input type="text" class="form-control" id="direccion">
            </div>
        </div>
        <a class="btn btn-primary" id="save" onclick="create()">Guardar</a>
        <a class="btn btn-primary" id="edit" onclick="update()">Actualizar</a>
        </form>
    </div>
    <br>
    <div class="container">
        <table id="laravel-datatable-crud" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
  </div>

</main>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>




<script>
$(document).ready( function () {
     $("#success").hide();
     $("#edit").hide();
    index()
});

function index(){
      $('#laravel-datatable-crud').DataTable({
           processing: true,
           serverSide: false,
          ajax: {
            url: "{{ url('index') }}",
            type: 'GET',
           },
           columns: [
                    { data: 'nombre', name: 'nombre' },
                    { data: 'apellido', name: 'apellido' },
                    { data: 'telefono', name: 'telefono' },
                    { data: 'email', name: 'email' },
                    { data: 'direccion', name: 'direccion' },
                    { data: null,
                    render: function ( data, type, row ) {
                        return '<a class="btn btn-primary" onclick="edit('+ data.id +')">Editar</a>&nbsp;<a class="btn btn-primary" onclick="deleteUser('+ data.id +')">Eliminar</a>';
                    }}
                 ]
       });

}

function create() {
    $.ajax({
        type:'post',
        url: "{{ url('create') }}",
        data: {
                _token: "{{ csrf_token() }}",
                nombre:  $('#nombre').val(),
                apellido:  $('#apellido').val(),
                telefono:  $('#telefono').val(),
                correo:  $('#correo').val(),
                direccion:  $('#direccion').val(),
            },
        success:function(data){
            $('#laravel-datatable-crud').DataTable().ajax.reload();
            $('#nombre').val('')
            $('#apellido').val('')
            $('#telefono').val('')
            $('#correo').val('')
            $('#direccion').val('')
            $("#success").show();
            setTimeout(function(){  $("#success").hide(); }, 3000);
        },
          error: function(data){
             alert("Error Submitting Record!");
          }
   });
}

function edit(id) {
     $.ajax({
        type:'get',
        url: "{{ url('edit') }}/" + id,
        success:function(data){
            if (data.status) {
                $("#save").hide();
                $("#edit").show();
                $('#id').val(data.us.id)
                $('#nombre').val(data.us.nombre)
                $('#apellido').val(data.us.apellido)
                $('#telefono').val(data.us.telefono)
                $('#correo').val(data.us.email)
                $('#direccion').val(data.us.direccion)
            }
        },
          error: function(data){
             alert("Error, verifique duplicidad de datos");
          }
   });
}

function update() {
     $.ajax({
        type:'post',
        url: "{{ url('update') }}",
        data: {
                _token: "{{ csrf_token() }}",
                id:  $('#id').val(),
                nombre:  $('#nombre').val(),
                apellido:  $('#apellido').val(),
                telefono:  $('#telefono').val(),
                correo:  $('#correo').val(),
                direccion:  $('#direccion').val(),
            },
        success:function(data){
            $("#edit").hide();
            $("#save").show();
            $('#laravel-datatable-crud').DataTable().ajax.reload();
            $('#nombre').val('')
            $('#apellido').val('')
            $('#telefono').val('')
            $('#correo').val('')
            $('#direccion').val('')
            $("#success").show();
            setTimeout(function(){  $("#success").hide(); }, 3000);
        },
          error: function(data){
             alert("Error, verifique duplicidad de datos");
          }
   });
}


function deleteUser(id){
    let isDel = confirm("Esta seguro de eliminar")
    if (isDel) {
        $.ajax({
            type:'get',
            url: "{{ url('delete') }}/" + id,
            success:function(data){
                if (data.status) {
                    $('#laravel-datatable-crud').DataTable().ajax.reload();
                    $("#success").show();
                    setTimeout(function(){  $("#success").hide(); }, 3000);
                }
        },
          error: function(data){
             alert("Error");
          }
   });

    }
}

</script>

</html>
