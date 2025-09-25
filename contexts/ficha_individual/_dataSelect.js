class DataSelect {
  static tipoPuertaOpciones = [
    { id: '01', nombre: 'PRINCIPAL' },
    { id: '02', nombre: 'SECUNDARIA' },
    { id: '03', nombre: 'GARAGE' },
    { id: '04', nombre: 'ESTACIONAMIENTO' },
  ];

  static estadoCivilOpciones = [
    { value: '01', text: 'Soltero(a)' },
    { value: '02', text: 'Casado(a)' },
    { value: '03', text: 'Divorciado(a)' },
    { value: '04', text: 'Viudo(a)' },
    { value: '05', text: 'Conviviente' },
  ];

  static tipoDocumentoOpciones = [
    { value: '01', text: 'No presentó documento' },
    { value: '02', text: 'DNI' },
    { value: '03', text: 'Carnet Policía' },
    { value: '04', text: 'Carnet Fuerzas Armadas' },
    { value: '05', text: 'Partida de Nacimiento' },
    { value: '06', text: 'Pasaporte' },
    { value: '07', text: 'Carnet de Extranjería' },
    { value: '08', text: 'Otros' },
  ];

  static ubicacionOpciones = [
    { value: '01', text: 'Igual a UU.CC' },
    { value: '02', text: 'Otros' },
  ];

  static grupoHUOpciones = [
    { value: '01', text: 'Zona' },
    { value: '02', text: 'Sector' },
    { value: '03', text: 'Etapa' },
  ];

  static condicionTitularOpciones = [
    { value: '01', text: 'Propietario Único' },
    { value: '02', text: 'Sucesión intestada' },
    { value: '03', text: 'Poseedor' },
    { value: '04', text: 'Sociedad Conyugal' },
    { value: '05', text: 'Cotitularidad' },
    { value: '06', text: 'Litigio' },
    { value: '07', text: 'Otros' },
  ];

  static formaAdquisicionOpciones = [
    { value: '01', text: 'Compra Venta' },
    { value: '02', text: 'Antic Legitima' },
    { value: '03', text: 'Testamento' },
    { value: '04', text: 'Donación' },
    { value: '05', text: 'Adjudicación' },
    { value: '06', text: 'Fusión' },
    { value: '07', text: 'Expropiación' },
    { value: '08', text: 'Permuta' },
    { value: '09', text: 'Prescripción Adqui' },
    { value: '10', text: 'Ces. Der/Acciones' },
    { value: '11', text: 'Dacion pago' },
    { value: '12', text: 'Decl. Herederos' },
    { value: '13', text: 'Posesion' },
    { value: '14', text: 'Otros' },
  ];

  static personaJuridicaOpciones = [
    { value: '01', text: 'Empresa' },
    { value: '02', text: 'Cooperativa' },
    { value: '03', text: 'Asociación' },
    { value: '04', text: 'Fundación' },
    { value: '05', text: 'Otros' },
  ];
}
