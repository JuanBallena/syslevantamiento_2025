var viaTypesFromDatabase = [];
var viaNamesFromDatabase = [];
var doorTypesFromDatabase = [];

var codigosPuerta = [];

function createDoorTypeOptions(id, items)
{
    const selectDoorType = document.getElementById(id);

    for (const iterator of items) {
        
        const op = `
            <option value="${ iterator.value }"> ${ iterator.text }</option>
        `;

        selectDoorType.innerHTML += op;
    }
}

function createViaTypeOptions(id, items, idComponent) {

    const ulViaType = document.getElementById(id);
    ulViaType.innerHTML = "";

    for (const iterator of items) {
        
        const li = `
            <li 
                class="a-autocomplete__item" 
                onclick="onclickViaTypeOption('${ iterator.DESCRIPCION }', '${ iterator.CODIGO }', ${idComponent})"
            > ${ iterator.DESCRIPCION }</li>
        `;

        ulViaType.innerHTML += li;
    }
}

function createViaNameOptions(id, items, idComponent) {

    const ulViaName = document.getElementById(id);

    ulViaName.innerHTML = "";

    for (const iterator of items) {
        
        const li = `
            <li 
                class="a-autocomplete__item" 
                onclick="onclickViaNameOption('${ iterator.nombvia.trim() }', '${ String(iterator.codcalle) }', ${idComponent})"
            > ${ iterator.nombvia.trim() }</li>
        `;

        ulViaName.innerHTML += li;
    }
}

function onclickViaType(index)
{
    const viaTypes = document.getElementById("via-type-options-container-" + index);
    viaTypes.classList.add("u-d-block");
    viaTypes.classList.remove("u-d-none");
}

function onblurViaType(index)
{
    const viaTypes = document.getElementById("via-type-options-container-" + index);
    viaTypes.classList.remove("u-d-block");
    viaTypes.classList.add("u-d-none");
}

function onclickViaTypeOption(text, value, index)
{
    const viaTypes = document.getElementById("via-type-options-container-" + index);
 
    viaTypes.classList.remove("u-d-block");
    viaTypes.classList.add("u-d-none");

    document.getElementById("via-type-text-" + index).value = text;
    document.getElementById("via-type-value-" + index).value = value;
}

function onclickViaName(index)
{
    const viaNames = document.getElementById("via-name-options-container-" + index);
    viaNames.classList.add("u-d-block");
    viaNames.classList.remove("u-d-none");
}

function onblurViaName(index)
{
    const viaNames = document.getElementById("via-name-options-container-" + index);
    viaNames.classList.remove("u-d-block");
    viaNames.classList.add("u-d-none");
}

function onclickViaNameOption(text, value, index)
{
    const viaNames = document.getElementById("via-name-options-container-" + index);
    viaNames.classList.remove("u-d-block");
    viaNames.classList.add("u-d-none");

    document.getElementById("via-name-text-" + index).value = text;
    document.getElementById("via-name-value-" + index).value = value;
}

async function onkeyupViaType(event, idComponent)
{
    let autocompleteText = event.target.value;

    if (autocompleteText.length > 3) 
    {
        const { data } = await axios.post('viaTypesFilter.php', { autocompleteText: autocompleteText });
        createViaTypeOptions("via-type-options-" + idComponent, data, idComponent);
    }
}

async function onkeyupViaName(event, idComponent)
{
    let autocompleteText = event.target.value;

    if (autocompleteText.length > 3) 
    {
        const { data } = await axios.post('viaNameFilter.php', { autocompleteText: autocompleteText });
      
        createViaNameOptions("via-name-options-" + idComponent, data, idComponent);
    }
}

var idComponent = 0;

var viasAcumulator = [
    {
        index: 0,
        doors: 0
    }
]

function onclickAddVia()
{
    idComponent++;

    viasAcumulator.push({ 
        index: idComponent,
        doors: 0 
    });

    var newVia = document.createElement('div');

    newVia.innerHTML = ` 
        <div class="m-form-section u-relative" id="via${ idComponent }">
            <div class="a-close-button is-danger-color" onclick="deleteVia(${ idComponent })">
                x
            </div>
            <div class="m-form-section__title">Via</div>

            <div class="o-grid o-grid__five-columns">
                <div class="o-grid__first-column">
                    <label class="a-label">Tipo de Vía</label>
                    <div class="a-autocomplete">
                        <input type="hidden" id="via-type-value-${ idComponent }">
                        <input
                            type="text"
                            class="a-input-text"
                            placeholder="Escribe"
                            tabindex="1"
                            onclick="onclickViaType(${ idComponent })"
                            onblur="onblurViaType(${ idComponent })"
                            onkeyup="onkeyupViaType(event, ${ idComponent })"
                            id="via-type-text-${ idComponent }"
                        />
                        <div 
                            class="a-autocomplete__box u-d-none"
                            id="via-type-options-container-${ idComponent }"
                            onmousedown="event.preventDefault()"
                        >
                            <ul class="a-autocomplete__items" 
                                id="via-type-options-${ idComponent }">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="o-grid__second-column">
                    <label class="a-label">Nombre de Vía</label>
                        <div class="a-autocomplete">
                        <input type="hidden" id="via-name-value-${ idComponent }">
                        <input
                            type="text"
                            class="a-input-text"
                            placeholder="Escribe"
                            tabindex="1"
                            onclick="onclickViaName(${ idComponent })"
                            onblur="onblurViaName(${ idComponent })"
                            onkeyup="onkeyupViaName(event, ${ idComponent })"
                            id="via-name-text-${ idComponent }"
                        />
                        <div 
                            class="a-autocomplete__box u-d-none"
                            id="via-name-options-container-${ idComponent }"
                            onmousedown="event.preventDefault()"
                        >
                            <ul class="a-autocomplete__items"
                                id="via-name-options-${ idComponent }"
                            >
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="o-grid o-grid--14rem" id="doors-${ idComponent }">
                <div>
                    <div class="o-container u-relative" id="door-${ idComponent }${0}">
                        <div class="a-close-button is-danger-color" onclick="deleteDoor(${idComponent}, ${0})">
                            x
                        </div>
                        <div class="a-text--center">Puerta</div>
                        <label class="a-label">Tipo</label>
                        <select 
                            class="a-input-text" 
                            ame="" 
                            id="door-type-${ idComponent }${0}">
                        </select>

                        <label class="a-label">Nro. Municipal</label>
                        <input 
                            class="a-input-text" 
                            type="text"
                            id="municipal-number-${ idComponent }${0}">
                    </div>
                </div>
            </div>

            <div>
                <button 
                    type="button"
                    class="a-btn a-btn--secondary" 
                    onclick="onclickAddDoor(${idComponent})">
                    Añadir Puerta
                </button>
            </div>
        </div>
    `;

    const vias = document.getElementById("vias");
    vias.appendChild(newVia);

    createDoorTypeOptions(
        "door-type-" + idComponent + viasAcumulator[idComponent]['doors'],
        doorTypesFromDatabase
    );

}

function onclickAddDoor(idComponent)
{
    viasAcumulator[idComponent]['doors']++;

    var newDoor = document.createElement('div');

    newDoor.innerHTML = ` 
        <div class="o-container u-relative" id="door-${ idComponent }${viasAcumulator[idComponent]['doors']}">
            <div class="a-close-button is-danger-color" onclick="deleteDoor(${idComponent}, ${viasAcumulator[idComponent]['doors']})">
                x
            </div>
            <div class="a-text--center">Puerta</div>
            <label class="a-label">Tipo </label>
            <select 
                name=""
                class="a-input-text" 
                id="door-type-${idComponent}${viasAcumulator[idComponent]['doors']}">
            </select>

            <label class="a-label">Nro. Municipal</label>
            <input 
                type="text"
                name=""
                class="a-input-text" 
                id="municipal-number-${idComponent}${viasAcumulator[idComponent]['doors']}">
        </div>
    `;

    const vias = document.getElementById("doors-" + idComponent);
    vias.appendChild(newDoor);

    createDoorTypeOptions(
        "door-type-" + idComponent + viasAcumulator[idComponent]['doors'],
        doorTypesFromDatabase
    );
}

function deleteVia(viaIndex)
{
    const via = document.getElementById("via" + viaIndex);
    via.remove();

    //const { data } = await axios.post('deleteVia.php',via );
    idComponent--;

    viasAcumulator = viasAcumulator.filter(function( obj ) {
        return obj.index !== viaIndex;
    });
    

}

function deleteDoor(viaIndex, doorIndex)
{
    const door = document.getElementById("door-" + viaIndex + doorIndex);
    door.parentNode.remove();

    //const { data } = await axios.post('deleteDoor.php',via );
    viasAcumulator[viaIndex]['doors']--;
}

function setDoorTypes(values)
{
    
    doorTypesFromDatabase = values;
    createDoorTypeOptions("door-type-00", values);
}

// descripcion del tipo de via
async function viaTypeOption(idViaType)
{
    const { data } = await axios.post('viaTypesOption.php',idViaType );
    return data['DESCRIPCION'];
}

// descripcion del nombre de via
async function viaNameOption(idViaName)
{
    const { data } = await axios.post('viaNameOption.php',idViaName );
    return data['nombvia'];
}

// array de puertas que pertenece a una via
async function listaPuertasVia(idUniCat, idVia)
{
    const formData = new FormData();
    formData.append('idUniCat', idUniCat);
    formData.append('idVia', idVia);
    
    const { data } = await axios.post('listaPuertasVia.php', formData);

    return data;
}

async function loadVias(vias)
{
    for (const [index, via] of vias.entries()) 
    {     
        let viaType = await this.viaTypeOption(via.c_tip_via);
        let viaName = await this.viaNameOption(via.c_cod_via.slice(1));
        let doors = await this.listaPuertasVia(via.c_id_uni_cat, via.c_id_via);

        document.getElementById("via-type-text-" + index).value = viaType;
        document.getElementById("via-type-value-" + index).value = via.c_tip_via;

        document.getElementById("via-name-text-" + index).value = viaName;
        document.getElementById("via-name-value-" + index).value = via.c_cod_via;

        for (const [indexDoor, door] of doors.entries()) 
        {
            codigosPuerta.push(door.i_codi_puerta);
            document.getElementById("municipal-number-" + index + indexDoor).value = door.c_nume_muni;

            const itemsSelect = document.getElementById("door-type-" + index + indexDoor);

            for (const itemSelect of itemsSelect) 
            {
                if (itemSelect.value == door.i_tipo_puerta) itemSelect.setAttribute('selected', 'selected');
            }

            if (indexDoor + 1 < doors.length) this.onclickAddDoor(index);
        }

        if (index + 1 < vias.length) this.onclickAddVia();
    }
}

