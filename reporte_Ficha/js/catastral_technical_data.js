function loadInputValuesCatastralTechnicalData(dni, nombre, apellidop, apellidom, id)
{
    document.getElementById("input-tc-dni").value = dni;
    document.getElementById("input-tc-nombre").value = nombre;
    document.getElementById("input-tc-apellidoP").value = apellidop;
    document.getElementById("input-tc-apellidoM").value = apellidom;
    document.getElementById("input-tc-id").value = id;
}

function createUsersptions(usuarios)
{
    const selectUsuarios = document.getElementById("select-nombreT");  

    let option = `<option value = 0 selected>Seleccione</option>`;
    selectUsuarios.innerHTML += option;
    for (const usuario of  usuarios) 
    {
        let option = "";
       
            option = `<option value="${usuario.c_id_usuario}">${usuario.nombre}</option>`;
      
        selectUsuarios.innerHTML += option;
    }
}
