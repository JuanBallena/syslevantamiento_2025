async function generateExcel(fichas) {

    // Config
    const letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD'];

    const ALIGNMENT_CENTER_MIDDLE = {
        horizontal: 'center', 
        vertical: 'middle'
    };

    const ALIGNMENT_JUSTIFY_TOP = {
        horizontal: 'justify', 
        vertical: 'top'
    };

    const ALIGNMENT_CENTER_TOP = {
        horizontal: 'center', 
        vertical: 'top'
    };

    const FONT_HEADER = {
        size: 11,
        bold: true
    };

    const BORDER_HEADER = {
        top: { 
            style:'medium', 
            color: { argb:'000000' } 
        },
        right: { 
            style:'medium', 
            color: { argb:'000000' } 
        },
        bottom: { 
            style:'medium', 
            color: { argb:'000000' } 
        },
        left: { 
            style:'medium', 
            color: { argb:'000000' } 
        },
    };

    // Excel js
    const workbook = new ExcelJS.Workbook();

    const worksheet =  workbook.addWorksheet('My Sheet', {
        pageSetup:{ paperSize: 12, orientation:'landscape' }
    });

    const rowTitle = 2;

    worksheet.mergeCells(`A${rowTitle}:AD${rowTitle}`);
    worksheet.getCell(`A${rowTitle}`).value = 'REPORTE DE LEVANTAMIENTO CATASTRAL POR CÓDIGO DE REFERENCIA';
    worksheet.getCell(`A${rowTitle}`).alignment = ALIGNMENT_CENTER_MIDDLE; 

    worksheet.getCell(`A${rowTitle}`).font = {
        size: 12,
        bold: true
    };

    // Columns
    const columns = [
       { key: 'Nro Orden', width: 12 },
       { key: 'DEPARTAMENTO', width: 15 },
       { key: 'PROVINCIA', width: 15 },
       { key: 'DISTRITO', width: 15 },
       { key: 'CÓDIGO REFERENCIA', width: 30 },
       { key: 'CODI_MZNA', width: 15 },
       { key: 'NUMERO_MANZANA', width: 20 },
       { key: 'LOTE', width: 10 },
       { key: 'CODI_LOTE', width: 15 },
       { key: 'TIPO_VIA', width: 20 },
       { key: 'NOMB_VIA', width: 20 },
       { key: 'CODI_VIA', width: 15 },
       { key: 'TIPO PUERTA', width: 15 },
       { key: 'NRO MUNICIPAL', width: 20 },
       { key: 'CODI_USO', width: 15 },
       { key: 'DESC_USO', width: 25 },
       { key: 'REFERENCIAL_USO', width: 25 },
       { key: 'LUZ', width: 10 },
       { key: 'AGUA', width: 10 },
       { key: 'DESAGUE', width: 10 },
       { key: 'GAS', width: 10 },
       { key: 'NUME_PISO', width: 20 },
       { key: 'ESTR_MURO_COL', width: 20 },
       { key: 'ESTR_TECHO', width: 20 },
       { key: 'ACAB_PUERTA_VEN', width: 20 },
       { key: 'MEP', width: 20 },
       { key: 'Cant. Medidores', width: 20 },
       { key: 'OBSERVACIONES', width: 30 },
       { key: 'NOMBRE COMPLETO', width: 25 },
       { key: 'FECHA LEVANTAMIENTO', width: 25 }
    ];

    worksheet.columns = columns;

    // Headers
    const rowHeaders = 4;

    const headers = [
        { text: 'UBIGEO', mergeCells: `B${rowHeaders}:D${rowHeaders}`, initialCell: `B${rowHeaders}`},
        { text: 'MANZANAS', mergeCells: `E${rowHeaders}:G${rowHeaders}`, initialCell: `E${rowHeaders}`},
        { text: 'LOTES', mergeCells: `H${rowHeaders}:I${rowHeaders}`, initialCell: `H${rowHeaders}`},
        { text: 'VIA', mergeCells: `J${rowHeaders}:L${rowHeaders}`, initialCell: `J${rowHeaders}`},
        { text: 'PUERTAS', mergeCells: `M${rowHeaders}:N${rowHeaders}`, initialCell: `M${rowHeaders}`},
        { text: 'USOS', mergeCells: `O${rowHeaders}:Q${rowHeaders}`, initialCell: `O${rowHeaders}`},
        { text: 'SERVICIOS BÁSICOS', mergeCells: `R${rowHeaders}:U${rowHeaders}`, initialCell: `R${rowHeaders}`},
        { text: 'CONSTRUCCIONES', mergeCells: `V${rowHeaders}:AA${rowHeaders}`, initialCell: `V${rowHeaders}`},
        { text: 'OBSERVACIONES', mergeCells: '', initialCell: `AB${rowHeaders}`},
        { text: 'USUARIOS', mergeCells: `AC${rowHeaders}:AD${rowHeaders}`, initialCell: `AC${rowHeaders}`}
    ];

    for (const header of headers) 
    {
        if (header.mergeCells != '') worksheet.mergeCells(header.mergeCells);

        worksheet.getCell(header.initialCell).value = header.text;
        worksheet.getCell(header.initialCell).alignment = ALIGNMENT_CENTER_MIDDLE; 
        worksheet.getCell(header.initialCell).font = FONT_HEADER;
        worksheet.getCell(header.initialCell).border = BORDER_HEADER;
    }

    // Sub headers
    const rowSubheaders = 5;

    const subheaders = [
        'Nro Orden',
        'DEPARTAMENTO',
        'PROVINCIA',
        'DISTRITO',
        'CÓDIGO REFERENCIA',
        'CODI_MZNA',
        'NUMERO_MANZANA',
        'LOTE',
        'CODI_LOTE',
        'TIPO_VIA',
        'NOMB_VIA',
        'CODI_VIA',
        'TIPO PUERTA',
        'NRO MUNICIPAL',
        'CODI_USO',
        'DESC_USO',
        'REFERENCIAL_USO',
        'LUZ',
        'AGUA',
        'DESAGUE',
        'GAS',
        'NUME_PISO',
        'ESTR_MURO_COL',
        'ESTR_TECHO',
        'ACAB_PUERTA_VEN',
        'MEP',
        'Cant. Medidores',
        'OBSERVACIONES',
        'NOMBRE COMPLETO',
        'FECHA LEVANTAMIENTO'
    ];

    for (const [index, subheader] of subheaders.entries()) 
    {
        worksheet.getCell(`${letters[index]}${rowSubheaders}`).value = subheader;
        worksheet.getCell(`${letters[index]}${rowSubheaders}`).alignment = ALIGNMENT_CENTER_MIDDLE; 
        worksheet.getCell(`${letters[index]}${rowSubheaders}`).font = FONT_HEADER;
        worksheet.getCell(`${letters[index]}${rowSubheaders}`).border = BORDER_HEADER;
    }

    // Data
    let rowInitialData = 6;

    for (const [index, ficha] of fichas.entries()) 
    {
        worksheet.getCell(`A${rowInitialData}`).value = index + 1;

        worksheet.getCell(`B${rowInitialData}`).value = ficha.c_id_uni_cat.substring(0,1);

        worksheet.getCell(`C${rowInitialData}`).value = ficha.c_id_uni_cat.substring(0,1);

        worksheet.getCell(`D${rowInitialData}`).value = ficha.c_id_uni_cat.substring(0,1);

        worksheet.getCell(`E${rowInitialData}`).value = ficha.c_id_uni_cat;

        worksheet.getCell(`F${rowInitialData}`).value = ficha.c_id_uni_cat.substring(8,10);

        worksheet.getCell(`G${rowInitialData}`).value = ficha.c_manzana;

        worksheet.getCell(`H${rowInitialData}`).value = ficha.c_id_uni_cat.substring(11,13);

        worksheet.getCell(`I${rowInitialData}`).value = ficha.c_lote;

        worksheet.getCell(`J${rowInitialData}`).value = ficha.c_nombre_tipoVia;

        worksheet.getCell(`K${rowInitialData}`).value = ficha.c_nombre_via;

        worksheet.getCell(`L${rowInitialData}`).value = ficha.c_cod_via;

        worksheet.getCell(`M${rowInitialData}`).value = ficha.i_tipo_puerta;

        worksheet.getCell(`N${rowInitialData}`).value = ficha.c_nume_muni;

        worksheet.getCell(`O${rowInitialData}`).value = ficha.c_codi_uso;

        worksheet.getCell(`P${rowInitialData}`).value = ficha.c_desc_uso;

        worksheet.getCell(`Q${rowInitialData}`).value = ficha.c_referencial_uso;

        worksheet.getCell(`R${rowInitialData}`).value = ficha.c_luz;

        worksheet.getCell(`S${rowInitialData}`).value = ficha.c_agua;

        worksheet.getCell(`T${rowInitialData}`).value = ficha.c_desague;

        worksheet.getCell(`U${rowInitialData}`).value = ficha.c_gas;

        worksheet.getCell(`V${rowInitialData}`).value = ficha.pisos;

        worksheet.getCell(`W${rowInitialData}`).value = ficha.muro;

        worksheet.getCell(`X${rowInitialData}`).value = ficha.techo;

        worksheet.getCell(`Y${rowInitialData}`).value = ficha.puerta;

        worksheet.getCell(`Z${rowInitialData}`).value = ficha.material;

        worksheet.getCell(`AA${rowInitialData}`).value = ficha.i_medidores;

        worksheet.getCell(`AB${rowInitialData}`).value = ficha.c_observaciones;

        worksheet.getCell(`AC${rowInitialData}`).value = ficha.usuario;

        worksheet.getCell(`AD${rowInitialData}`).value = ficha.d_fecha;
    }

    await workbook.xlsx.writeBuffer()
        .then((buffer) => global.saveAs(new Blob([buffer]), `reporte.xlsx`))
        .catch((e) => alert(`Error writing excel export ${e}`));
}