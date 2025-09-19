function createOptionsGeneric(id, construcciones, keyValueConstruccion, keyTextConstruccion, items, keyValue, keyText)
{
  
    const select = document.getElementById(id);

    let option = `<option value="">Seleccione</option>`;
    select.innerHTML += option;

    if (construcciones != null)
    {
        const construccion = construcciones;

        for (const item of items) 
        {
            let option = "";
 
            if (item[keyValue] == construccion[keyValueConstruccion])
            {                
                option = `<option value="${construccion[keyValueConstruccion]}" selected>${construccion[keyTextConstruccion]}</option>`;
            }
            else
            {
                option = `<option value="${item[keyValue]}">${item[keyText]}</option>`;
            }

            select.innerHTML += option;
        } 
    }
    else
    {
        for (const item of items) 
        {
            let option = `<option value="${item[keyValue]}">${item[keyText]}</option>`;

            select.innerHTML += option;
        }
    }
}


function createOptionsBuildings(categorias)
{
    const selectEstados = document.getElementById("select-estados");   

    let option = `<option value = 0 selected>Seleccione</option>`;
    selectEstados.innerHTML += option;
    for (const categoria of  Object.keys(categorias)) 
    {
        let option = "";
       
            option = `<option value="${estado.i_cod_est_unid}">${estado.c_des_est_unid}</option>`;
      
        selectEstados.innerHTML += option;
    }
}

function createOptionsFloorNumbers(construcciones,floorNumbers)
{
     this.createOptionsGeneric(
        "select-nroPiso",
        construcciones,
        'idpisos',
        'pisos',
        floorNumbers,
        'c_cod_pisos',
        'c_desc_pisos'
    );
}

function createOptionsWallsAndColumns(construcciones,wallsAndColumns)
{
    this.createOptionsGeneric(
        "select-walls-and-columns",
        construcciones,
        'idmuro',
        'muro',
        wallsAndColumns,
        'i_cod_tip_categoria',
        'c_des_tip_categoria'
    );
}

function createOptionsCeilings(construcciones,ceilings)
{
    this.createOptionsGeneric(
        "select-ceilings",
        construcciones,
        'idtecho',
        'techo',
        ceilings,
        'i_cod_tip_categoria',
        'c_des_tip_categoria'
    );
}

function createOptionsDoorsAndWindows(construcciones, doorsAndWindows)
{
    this.createOptionsGeneric(
        "select-doors-and-windows",
        construcciones,
        'idpuerta',
        'puerta',
        doorsAndWindows,
        'i_cod_tip_categoria',
        'c_des_tip_categoria'
    );
}

function createOptionsFloors(construcciones,floors)
{
    this.createOptionsGeneric(
        "select-floors",
        construcciones,
        'idpiso',
        'piso',
        floors,
        'i_cod_tip_categoria',
        'c_des_tip_categoria'
    );
}

function createOptionsMaterials(construcciones, materials)
{
    this.createOptionsGeneric(
        "select-materials",
        construcciones,
        'idmep',
        'material',
        materials,
        'i_cod_tip_material',
        'c_des_tip_material'
    );
    
}




