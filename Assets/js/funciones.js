let tblUsuarios, tblPacientes, tblCitas, tblHistorial;
document.addEventListener("DOMContentLoaded", function(){
    tblUsuarios= $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id',
            },
            {
                'data' : 'usuario'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'especialidad'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'

            }
        ]
    } );
    tblPacientes= $('#tblPacientes').DataTable( {
        ajax: {
            url: base_url + "Pacientes/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id',
            },
            {
                'data' : 'dni'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'telefono'
            },
            {
                'data' : 'direccion'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'

            }
        ]
    } );
    tblCitas= $('#tblCitas').DataTable( {
        ajax: {
            url: base_url + "Citas/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id',
            },
            {
                'data' : 'descripcion'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'hora'
            },
            {
                'data' : 'usuario'
            },
            {
                'data' : 'paciente'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'

            }
        ]
    } );
    tblHistorial= $('#tblHistorial').DataTable( {
        ajax: {
            url: base_url + "Historial/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id',
            },
            {
                'data' : 'codigo'
            },
            {
                'data' : 'edad'
            },
            {
                'data' : 'antecedentes'
            },
            {
                'data' : 'alergias'
            },
            {
                'data' : 'paciente'
            },
            {
                'data' : 'especialidad'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'

            }
        ]
    } );
})

function frmUsuario(){
    document.getElementById("title").innerHTML="Nuevo usuario";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value="";
}
function registrarUser(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre=document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar=document.getElementById("confirmar");
    const especialidad=document.getElementById("especialidad");
    if(usuario.value == ""||nombre.value == ""||especialidad.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }else{
        const url = base_url + "Usuarios/registrar";
        const fmr=document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(fmr));
        http.onreadystatechange=function(){
            if(this.readyState ==4 && this.status==200){
                const res =JSON.parse(this.responseText);
                if(res=="si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Usuario registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                }else if(res=="modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Usuario modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }

}
function btnEditarUser(id){
    document.getElementById("title").innerHTML="Actualizar usuario";
    document.getElementById("btnAccion").innerHTML="Modificar";
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET",url,true);
    http.send();
    http.onreadystatechange=function(){
        if(this.readyState ==4 && this.status==200){
            const res=JSON.parse(this.responseText);
            document.getElementById("id").value=res.id;
            document.getElementById("usuario").value=res.usuario;
            document.getElementById("nombre").value=res.nombre;
            document.getElementById("especialidad").value=res.id_especialidad;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}
function btnEliminarUser(id){
    Swal.fire({
        title: "Esta seguro de eliminar?",
        text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Usuario eliminado con exito.",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }     
        }
        })
}
function btnReingresarUser(id){
    Swal.fire({
        title: "Esta seguro de reingresar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                 if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Usuario reingresado con exito.",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }
            
        }
    })
}
//FIN USUARIOS
function frmPaciente(){
    document.getElementById("title").innerHTML="Nuevo Paciente";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmPaciente").reset();
    $("#nuevo_paciente").modal("show");
    document.getElementById("id").value= "";
}
function registrarPac(e){
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if(dni.value == ""||nombre.value == ""||telefono.value == ""||direccion.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Pacientes/registrar";
        const fmr=document.getElementById("frmPaciente");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(fmr));
        http.onreadystatechange=function(){
            if(this.readyState ==4 && this.status==200){
                const res =JSON.parse(this.responseText);
                if(res=="si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Paciente registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_paciente").modal("hide");
                      tblPacientes.ajax.reload();
                }else if(res=="modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Paciente modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_paciente").modal("hide");
                     tblPacientes.ajax.reload();
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
            }
        }
    }
}
function btnEditarPac(id){
    document.getElementById("title").innerHTML = "Actualizar paciente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Pacientes/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono; 
            document.getElementById("direccion").value=res.direccion;
            $("#nuevo_paciente").modal("show");       
        }
    }
}
function btnEliminarPac(id){
    Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El paciente no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No"
    }).then((result) => {
    if (result.isConfirmed) {
        const url = base_url + "Pacientes/eliminar/" + id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function(){
             if(this.readyState == 4 && this.status == 200){
                const res=JSON.parse(this.responseText);
                if(res=="ok"){
                    Swal.fire(
                        "Mensaje!",
                        "Paciente eliminado con exito.",
                        "success"
                    )
                    tblPacientes.ajax.reload();
                }else{
                    Swal.fire(
                        "Mensaje!",
                        res,
                        "error"
                    )
                }
             }
        }
        
    }
    })
}
function btnReingresarPac(id){
    Swal.fire({
    title: "Esta seguro de reingresar el paciente?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No"
    }).then((result) => {
    if (result.isConfirmed) {
        const url = base_url + "Pacientes/reingresar/" + id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function(){
             if(this.readyState == 4 && this.status == 200){
                const res=JSON.parse(this.responseText);
                if(res=="ok"){
                    Swal.fire(
                        "Mensaje!",
                        "Paciente reingresado con exito.",
                        "success"
                    )
                    tblPacientes.ajax.reload();
                }else{
                    Swal.fire(
                        "Mensaje!",
                        res,
                        "error"
                    )
                }
             }
        }
        
    }
    })
}
//FIN PACIENTE
function frmCita(){
    document.getElementById("title").innerHTML="Nueva Cita";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmCita").reset();
    document.getElementById("id").value="";
    $("#nuevo_cita").modal("show");
}
function registrarCit(e){
    e.preventDefault();
    const descripcion = document.getElementById("descripcion");
    const fecha=document.getElementById("fecha");
    const hora = document.getElementById("hora");
    const id_usuario=document.getElementById("usuario");
    const id_paciente=document.getElementById("paciente");
    if(descripcion.value == ""||fecha.value == ""||hora.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }else{
        const url = base_url + "Citas/registrar";
        const fmr=document.getElementById("frmCita");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(fmr));
        http.onreadystatechange=function(){
            if(this.readyState ==4 && this.status==200){
                const res =JSON.parse(this.responseText);
                if(res=="si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Cita registrada con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_cita").modal("hide");
                      tblCitas.ajax.reload();
                }else if(res=="modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Cita modificada con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_cita").modal("hide");
                      tblCitas.ajax.reload();
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }          
            }
        }
    }

}
function btnEditarCit(id){
    document.getElementById("title").innerHTML="Actualizar cita";
    document.getElementById("btnAccion").innerHTML="Modificar";
    const url = base_url + "Citas/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET",url,true);
    http.send();
    http.onreadystatechange=function(){
        if(this.readyState ==4 && this.status==200){
            const res=JSON.parse(this.responseText);
            document.getElementById("id").value=res.id;
            document.getElementById("descripcion").value=res.descripcion;
            document.getElementById("fecha").value=res.fecha;
            document.getElementById("hora").value=res.hora;
            document.getElementById("usuario").value=res.id_usuario;
            document.getElementById("paciente").value=res.id_paciente;
            $("#nuevo_cita").modal("show");
        }
    }
}
function btnEliminarCit(id){
    Swal.fire({
        title: "Esta seguro de eliminar?",
        text: "La cita no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Citas/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Cita eliminada con exito.",
                            "success"
                        )
                        tblCitas.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }     
        }
        })
}
function btnReingresarCit(id){
    Swal.fire({
        title: "Esta seguro de reingresar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Citas/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                 if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Cita reingresada con exito.",
                            "success"
                        )
                        tblCitas.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }
            
        }
    })
}
//FIN CITA
function frmHistorial(){
    document.getElementById("title").innerHTML="Nuevo Historial";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmHistorial").reset();
    document.getElementById("id").value="";
    $("#nuevo_historial").modal("show");
}
function registrarHis(e){
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const edad=document.getElementById("edad");
    const antecedentes = document.getElementById("antecedentes");
    const alergias=document.getElementById("alergias");
    const id_paciente=document.getElementById("paciente");
    const id_especialidad=document.getElementById("especialidad");
    if(codigo.value == ""||edad.value == ""||antecedentes.value == ""|alergias.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }else{
        const url = base_url + "Historial/registrar";
        const fmr=document.getElementById("frmHistorial");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(fmr));
        http.onreadystatechange=function(){
            if(this.readyState ==4 && this.status==200){
                const res =JSON.parse(this.responseText);
                if(res=="si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Historial Clinico registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_historial").modal("hide");
                      tblHistorial.ajax.reload();
                }else if(res=="modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Historial Clinico modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      })
                      $("#nuevo_historial").modal("hide");
                      tblHistorial.ajax.reload();
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }         
            }
        }
    }

}
function btnEditarHis(id){
    document.getElementById("title").innerHTML="Actualizar Historial Clinico";
    document.getElementById("btnAccion").innerHTML="Modificar";
    const url = base_url + "Historial/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET",url,true);
    http.send();
    http.onreadystatechange=function(){
        if(this.readyState ==4 && this.status==200){
            const res=JSON.parse(this.responseText);
            document.getElementById("id").value=res.id;
            document.getElementById("codigo").value=res.codigo;
            document.getElementById("edad").value=res.edad;
            document.getElementById("antecedentes").value=res.antecedentes;
            document.getElementById("alergias").value=res.alergias;
            document.getElementById("paciente").value=res.id_paciente;
            document.getElementById("especialidad").value=res.id_especialidad;
            $("#nuevo_historial").modal("show");
        }
    }
}
function btnEliminarHis(id){
    Swal.fire({
        title: "Esta seguro de eliminar?",
        text: "El historial clinico no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Historial/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Historial clinico eliminado con exito.",
                            "success"
                        )
                        tblHistorial.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }     
        }
        })
}
function btnReingresarHis(id){
    Swal.fire({
        title: "Esta seguro de reingresar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
        }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Historial/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                 if(this.readyState == 4 && this.status == 200){
                    const res=JSON.parse(this.responseText);
                    if(res=="ok"){
                        Swal.fire(
                            "Mensaje!",
                            "Historial clinico reingresado con exito.",
                            "success"
                        )
                        tblHistorial.ajax.reload();
                    }else{
                        Swal.fire(
                            "Mensaje!",
                            res,
                            "error"
                        )
                    }
                 }
            }
            
        }
    })
}