<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item active" style="font-weight: bold;">HISTORIAL CLINICO</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmHistorial();">Nuevo <i class="fas fa-plus"></i></button>
<table class="table table-dark" id="tblHistorial">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Edad</th>
            <th>Antecedentes</th>
            <th>Alergias</th>
            <th>Paciente</th>
            <th>Especialidad</th>
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
<div id="nuevo_historial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Historial</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmHistorial">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="codigo">Codigo</label>
                                    <input type="hidden" id="id" name="id">
                                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="edad">Edad</label>
                                    <input id="edad" class="form-control" type="text" name="edad" placeholder="Edad del paciente">
                                </div>
                            </div>
                        </div>              
                        <div class="form-group mb-2">
                            <label for="antecedentes">Antecedentes</label>
                            <input id="antecedentes" class="form-control" type="text" name="antecedentes" placeholder="Antecedentes del paciente">
                        </div>
                        <div class="form group mb-2">
                            <label for="alergias">Alergias</label>
                            <input id="alergias" class="form-control" type="text" name="alergias" placeholder="Alergia del paciente">
                        </div> 
                        <div class="row">
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
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="especialidad">Especialidad</label>
                                    <select id="especialidad" class="form-control" name="especialidad">
                                        <?php foreach($data['especialidad'] as $row) { ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['especialidad']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>      
                        <button class="btn btn-primary" type="button" onclick="registrarHis(event);" id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>