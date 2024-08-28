export function initDataTable(idTabla) {
    new DataTable(`#${idTabla}`, {
      language: {
        info: 'Mostrar registros de _START_ a _END_ ',
        infoEmpty: 'No hay registros',
        infoFiltered: '(filtered from _MAX_ total records)',
        lengthMenu: 'Mostrar _MENU_ registros',
        zeroRecords: 'No se encontraron coincidencias',
        search: 'Buscar:',
      }
    });
  }