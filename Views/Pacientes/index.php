<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item active" style="font-weight: bold;">PACIENTES</li>
</ol>
 <button class="btn btn-primary mb-2" type="button" onclick="frmPaciente();">Nuevo <i class="fas fa-plus"></i></button>
 <table class="table table-dark" id="tblPacientes">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Dni</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
 <div id="nuevo_paciente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Paciente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmPaciente">
                    <div class="form-group mb-2">
                        <label for="dni" >Dni</label>
                        <input type="hidden" id="id" name="id">
                        <input id="dni" class="form-control" type="text" name="dni" placeholder="Documento de Identidad">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del paciente">
                    </div>
                    <div class="form-group mb-2">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono">
                    </div>
                    <div class="form-group mb-3">
                        <label for="direccion">Dirección</label>
                        <textarea id="direccion" class="form-control" name="direccion" placeholder="Dirección" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarPac(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
 </div>
<?php include "Views/Templates/footer.php"; ?>