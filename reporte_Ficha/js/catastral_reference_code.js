
function loadInputValuesCatastralReferenceCode_Unidad(values)
{
    document.getElementById("input-sector").value  = values.sector;
    document.getElementById("input-manzana").value = values.manzana;
    document.getElementById("input-lote").value    = "0" + values.lote;
    document.getElementById("input-edifica").value = values.edifica;
    document.getElementById("input-entrada").value = values.entrada;
    document.getElementById("input-piso").value = values.piso;
 

}

function loadInputValuesCatastralReferenceCode(values)
{
    document.getElementById("input-sector").value  = values.sector;
    document.getElementById("input-manzana").value = values.manzana;
    document.getElementById("input-lote").value    = "0" + values.lote;
    document.getElementById("input-edifica").value = values.edifica;
    document.getElementById("input-entrada").value = values.entrada;
    document.getElementById("input-piso").value = values.piso;
    document.getElementById("input-unidad").value = values.unidad;
 

}
