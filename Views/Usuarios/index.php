<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item active" style="font-weight: bold;">DOCTORES</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();">Nuevo <i class="fas fa-plus"></i></button>
<table class="table table-dark" id="tblUsuarios">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Nombre del Doctor</th>
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
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group mb-2">
                            <label for="usuario">Usuario</label>
                            <input type="hidden" id="id" name="id">
                            <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del usuario">
                        </div>
                        <div class="row" id="claves">
                            <div class="col-md-6">
                                <div class="form group mb-2">
                                    <label for="clave">Contraseña</label>
                                    <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form group mb-2">
                                    <label for="confirmar">Confirmar contraseña</label>
                                    <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseña">
                                </div> 
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="especialidad">Especialidad</label>
                            <select id="especialidad" class="form-control" name="especialidad">
                                <?php foreach($data['especialidades'] as $row) { ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['especialidad']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>