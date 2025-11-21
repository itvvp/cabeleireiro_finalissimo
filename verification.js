(function(window, $) {
  'use strict';

  /**
   * validateEventForm(form)
   * - form: jQuery form element
   * Returns: { valid: Boolean, errors: {field: message, ...} }
   */
  function validateEventForm(form) {
    var errors = {};

    var tratamento = $.trim(form.find('[name="tratamento"]').val() || '');
    var cabeleireira = $.trim(form.find('[name="cabeleireira"]').val() || '');
    var NomeHospede = $.trim(form.find('[name="NomeHospede"]').val() || '');
    var startDate = $.trim(form.find('[name="startDate"]').val() || '');
    var startTime = $.trim(form.find('[name="startTime"]').val() || '');

    if (tratamento === '') errors.tratamento = 'A seleção do tratamento é obrigatória';
    if (cabeleireira === '') errors.cabeleireira = 'A seleção da cabeeleireira é obrigatória';
    if (NomeHospede === '') errors.NomeHospede = 'A seleção do Nome do Hospede é obrigatória';
    if (startDate === '') errors.startDate = 'Insira a data para o inicio do tratamento';
    if (startTime === '') errors.startTime = 'A hora de ínicio do tratamento é obrigatória';

    return { valid: Object.keys(errors).length === 0, errors: errors };
  }

  // expose globally
  window.validateEventForm = validateEventForm;

})(window, jQuery);