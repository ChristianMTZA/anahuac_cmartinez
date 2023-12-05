<!--Alert JS-->
<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<!-- You MUST include jQuery 3.4+ before Fomantic -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>

<center>
    <h2>Crear Colaborador</h2>
</center>
<div class="ui card centered" style="width: 80%; padding: 30px;">
    <form class="ui form" id="form" method="POST">
        @csrf
        <div class="three fields">
            <div class="field">
                <label for="nombre">Nombre(s)</label>
                <input type="text" name="nombre" autocomplete="off" placeholder="Nombre(s)" required>
            </div>
            <div class="field">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" autocomplete="off" placeholder="Apellido Paterno" required>
            </div>
            <div class="field">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" autocomplete="off" placeholder="Apellido Materno" required>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="edad">Edad</label>
                <input type="number" name="edad" min="15" placeholder="Edad" required>
            </div>
            <div class="field">
                <label for="permisos">Permisos</label>
                <input type="text" name="permisos" autocomplete="off" placeholder="Permisos" required>
            </div>
        </div>
        <div class="field">
            <button type="submit" value="enviar" class="ui fluid green icon button"><i class="save icon"></i> Crear Colaborador</button>
        </div>
    </form>
</div>

<script>
    // Manejar el envío del formulario
$(document).ready(function() {
    $('#form').submit(function(e) {
        e.preventDefault();
        let formulario = document.getElementById('form');
        // Realizar la petición AJAX al endpoint del controlador
        $.ajax({
            type: 'POST',
            url: "{{ url('/colaboradores') }}", // Reemplaza 'nombre.ruta.store' con la ruta adecuada
            data: $('#form').serialize(),
            success: function(response) {
                // Manejar la respuesta del servidor
                if (response.success) {
                    // Mostrar la alerta de confirmación
                    alertify.success(response.message);
                    // Limpiar el formulario
                    formulario.reset();
                } else {
                    // Mostrar una alerta de error si es necesario
                    alertify.error('Hubo un error al insertar los datos.');
                }
            },
            error: function(error) {
                // Mostrar una alerta de error en caso de error de la petición AJAX
                alertify.error('Hubo un error en la petición.');
            }
        });
    });
});
</script>