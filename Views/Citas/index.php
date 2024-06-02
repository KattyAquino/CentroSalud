<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item active" style="font-weight: bold;">CITAS</li>
</ol>
 <button class="btn btn-primary mb-2" type="button" onclick="frmCita();">Nuevo <i class="fas fa-plus"></i></button>
 <table class="table table-dark" id="tblCitas">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Motivo de la Cita</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Doctores</th>
            <th>Pacientes</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>
<div id="nuevo_cita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Cita</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCita">
                    <div class="form-group mb-2">
                            <label for="descripcion">Descripcion</label>
                            <input type="hidden" id="id" name="id">
                            <input id="descripcion" class="form-control" type="text" name="descripcion" placeholder="Motivo de la Cita">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group mb-2">
                                    <label for="fecha">Fecha</label>
                                    <input id="fecha" class="form-control" type="text" name="fecha" placeholder="Fecha">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form group mb-2">
                                    <label for="hora">Hora</label>
                                    <input id="hora" class="form-control" type="text" name="hora" placeholder="Hora">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="usuario">Doctores</label>
                                    <select id="usuario" class="form-control" name="usuario">
                                        <?php foreach($data['usuarios'] as $row) { ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['nombre']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="paciente">Pacientes</label>
                                    <select id="paciente" class="form-control" name="paciente">
                                        <?php foreach($data['pacientes'] as $row) { ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['nombre']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="registrarCit(event);" id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>