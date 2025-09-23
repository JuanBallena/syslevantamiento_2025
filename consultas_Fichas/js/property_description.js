// var usesAuthorizationNameValuesFromDatabase = [];

// function onclickCatastralProperty()
// {
//     const catastralPropertyItems = document.getElementById("uses-authorization-name-options-container");
//     catastralPropertyItems.classList.add("u-d-block");
//     catastralPropertyItems.classList.remove("u-d-none");
// }

// function onblurCatastralProperty()
// {
//     const catastralPropertyItems = document.getElementById("uses-authorization-name-options-container");
//     catastralPropertyItems.classList.remove("u-d-block");
//     catastralPropertyItems.classList.add("u-d-none");
// }

// function onclickUsesAuthorizationNameItem(text, value)
// {
//     const catastralPropertyItems = document.getElementById("uses-authorization-name-options-container");
//     catastralPropertyItems.classList.remove("u-d-block");
//     catastralPropertyItems.classList.add("u-d-none");

//     document.getElementById("uses-authorization-name-text").value = text;
//     document.getElementById("uses-authorization-name-value").value = value;
// }

// function loadInputValuesPropertyDescription(usos, referencial )
// {
//     if (referencial != null)
//     {
//         document.getElementById("uses-authorization-name-text").value = usos.Desc_Uso.trim();
//         document.getElementById("uses-authorization-name-value").value = usos.Cod_Uso;
//         document.getElementById("input-ref-uso").value = referencial;
//     }
//     else{
//         document.getElementById("uses-authorization-name-text").value = usos.Desc_Uso.trim();
//         document.getElementById("uses-authorization-name-value").value = usos.Cod_Uso;
//     }
// }

// function onkeyupUsesAuthorizationName(event)
// {
//     let autocompleteText = event.target.value;

//     const itemsFiltered = usesAuthorizationNameValuesFromDatabase.filter((item) => {
//         return item['Desc_Uso'].includes(autocompleteText) || item['Cod_Uso'].includes(autocompleteText);
//     });

//     createUsesAuthorizationNameOptions(itemsFiltered);
// }

// function createUsesAuthorizationNameOptions(items)
// {
//     const usesAuthorizationNameValues = document.getElementById("uses-authorization-name-options");

//     usesAuthorizationNameValues.innerHTML = "";

//     for (const item of items)
//     {
//         const li = `
//             <li class="a-autocomplete__item" onclick="onclickUsesAuthorizationNameItem('${item.Desc_Uso.trim()}', '${item.Cod_Uso}')">
//                 ${item.Cod_Uso} - ${item.Desc_Uso.trim()}
//             </li>
//         `;

//         usesAuthorizationNameValues.innerHTML += li;
//     }
// }

// function setUsesAuthorizationNameValuesFromDatabase(values)
// {
//     usesAuthorizationNameValuesFromDatabase = values;
// }
