var urbanAuthorizationNameValuesFromDatabase = [];

function createOptionsStateCatastralUnit(estadoUnidades, estados)
{
    const selectEstados = document.getElementById("select-estados");
    const estadoUnidad = estadoUnidades;     

    let option = `<option value = 0 selected>Seleccione</option>`;
    selectEstados.innerHTML += option;
    for (const estado of  estados) 
    {
        let option = "";

        if(estado.i_cod_est_unid == estadoUnidad.i_cod_est_unid)
        {
            option = `<option value="${estadoUnidad.i_cod_est_unid}" selected>${estadoUnidad.c_des_est_unid}</option>`;
        }
        else 
        {
            option = `<option value="${estado.i_cod_est_unid}">${estado.c_des_est_unid}</option>`;
        }
       

        selectEstados.innerHTML += option;
    }
}

function createOptionsStateCatastralUnit_I(estados)
{
    const selectEstados = document.getElementById("select-estados");  

    let option = `<option value = 0 selected>Seleccione</option>`;
    selectEstados.innerHTML += option;
    for (const estado of  estados) 
    {
        let option = "";
       
            option = `<option value="${estado.i_cod_est_unid}">${estado.c_des_est_unid}</option>`;
      
        selectEstados.innerHTML += option;
    }
}

function onChangeGrupoHU()
{
    const type = document.getElementById("select-grupoHU");
    const stageNumber = document.getElementById("stage-number");

    if (type.value == '03')
    {
        stageNumber.classList.remove("a-input-text--disabled");
        stageNumber.classList.add("a-input-text");
        stageNumber.removeAttribute("readonly");
        stageNumber.removeAttribute("disabled");
    }
    else 
    {
        stageNumber.classList.add("a-input-text--disabled");
        stageNumber.setAttribute("readonly", true);
        stageNumber.setAttribute("disabled", true);
        stageNumber.value = 0;
    }
}

function createOptionsHuGroup(fichaGroupHus,GroupHus)
{
    const selectGroupHus  = document.getElementById("select-grupoHU");
    const fichaGroupHu = fichaGroupHus;

    let option = `<option value="">Seleccione</option>`;
    selectGroupHus.innerHTML += option;

    for (const groupHu of GroupHus) 
    {
        let option = "";

        if (groupHu.c_cod_tip_zce == fichaGroupHu.c_cod_tip_zce)
        {
            option = `<option value="${fichaGroupHu.c_cod_tip_zce}" selected>${fichaGroupHu.c_desc_tip_zce}</option>`;
        }
        else
        {
            option = `<option value="${groupHu.c_cod_tip_zce}">${groupHu.c_desc_tip_zce}</option>`;
        }

        selectGroupHus.innerHTML += option;
    } 
}

/////////////

function loadInputValuesCatastralPropertyLocation(hu, manzana, lote, sublote, numEtapa)
{
    document.getElementById("urban-authorization-name-text").value = hu.nombre.trim();
    document.getElementById("urban-authorization-name-value").value = hu.codurba;
    document.getElementById("input-mzna-Dist").value = manzana;
    document.getElementById("input-lote-Dist").value = lote;
    document.getElementById("input-subLote-Dist").value = sublote;
    document.getElementById("stage-number").value = numEtapa;

}

function loadInputValuesCatastralPropertyLocation_I(hu)
{
    document.getElementById("urban-authorization-name-text").value = hu.nombre.trim();
    document.getElementById("urban-authorization-name-value").value = hu.codurba;


}

function onclickUrbanAuthorizationName()
{
    const urbanAuthorizationNameOptions = document.getElementById("urban-authorization-name-options-container");
    urbanAuthorizationNameOptions.classList.add("u-d-block");
    urbanAuthorizationNameOptions.classList.remove("u-d-none");
}

function onblurUrbanAuthorizationName()
{
    const urbanAuthorizationNameOptions = document.getElementById("urban-authorization-name-options-container");
    urbanAuthorizationNameOptions.classList.remove("u-d-block");
    urbanAuthorizationNameOptions.classList.add("u-d-none");
}

function onclickUrbanAuthorizationNameOption(text, value)
{
    const urbanAuthorizationNameOptions = document.getElementById("urban-authorization-name-options-container");
    urbanAuthorizationNameOptions.classList.remove("u-d-block");
    urbanAuthorizationNameOptions.classList.add("u-d-none");

    document.getElementById("urban-authorization-name-text").value = text;
    document.getElementById("urban-authorization-name-value").value = value;
}

function onkeyupUrbanAuthorizationName(event)
{
    let autocompleteText = event.target.value;
    
    const itemsAutocompleteFiltered = urbanAuthorizationNameValuesFromDatabase.filter((item) => {
        return item['nombre'].includes(autocompleteText) || item['codurba'].includes(autocompleteText);
    });

    createUrbanAuthorizationNameOptions(itemsAutocompleteFiltered);
}

function createUrbanAuthorizationNameOptions(items)
{
    const urbanAuthorizationNameOptions = document.getElementById("urban-authorization-name-options");

    urbanAuthorizationNameOptions.innerHTML = "";

    for (const item of items) 
    {
        const li = `
            <li class="a-autocomplete__item" 
                onclick="onclickUrbanAuthorizationNameOption('${item.nombre.trim()}', ${item.codurba})">                                                                     
                ${item.codurba} - ${item.nombre.trim()}
            </li>
        `;

        urbanAuthorizationNameOptions.innerHTML += li;
    }
}

function setUrbanAuthorizationNameValuesFromDatabase(values)
{
    urbanAuthorizationNameValuesFromDatabase = values;
}
