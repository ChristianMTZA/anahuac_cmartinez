<!--Alert JS-->
<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<!-- You MUST include jQuery 3.4+ before Fomantic -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<center>
    <h2>Lista de Colaboradores</h2>
</center>
<div class="ui card centered" style="width: 90%; padding: 30px;">
    <table class="ui table" id="show_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido Materno</th>
                <th>Edad</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colaboradores as $colaborador)
            <tr>
                <td>{{$colaborador->id}}</td>
                <td>{{$colaborador->nombre}}</td>
                <td>{{$colaborador->apellido_paterno}}</td>
                <td>{{$colaborador->apellido_materno}}</td>
                <td>{{$colaborador->edad}}</td>
                <td>{{$colaborador->permisos}}</td>
                <td>
                    <button type="submit" class="ui red icon button delete-button" data-id="{{ $colaborador->id}}"><i class="trash icon"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Manejar el envío del formulario
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var id = $(this).data('id');
            var token = $('meta[name="csrf-token"]').attr('content');
            // mensaje de confirmanción
            alertify.confirm('Soy León', '¿Realmente quieres eliminar este colaborador?.', function() {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('/colaboradores') }}/" + id,
                    data: {
                        _token: token,
                    },
                    success: function(response) {
                        if (response.success) {
                            alertify.success(response.message);
                            // refrescar el sitio
                            window.location.reload();
                        } else {
                            alertify.error('Hubo un error al eliminar al colaborador');
                        }
                    },
                    error: function(error) {
                        alertify.error('Hubo un error en la petición.');
                    }
                });
            }, function() {
                // no hace nada si no se cancela
            }).set('labels', {
                ok: 'Sí, continuar',
                cancel: 'Cancelar'
            });
        });
    });

    //override defaults
    alertify.defaults.transition = "zoom";
    alertify.defaults.theme.ok = "ui positive button";
    alertify.defaults.theme.cancel = "ui black button";
</script>