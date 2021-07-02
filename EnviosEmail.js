var EnviosEmail = function () {

    var pageID = '#envios';


    var handleFormActions = function (id) {

        var formulario = $(pageID + '_form');

        formulario.off('click', '.stdFormAction').on('click', '.stdFormAction', function (e) {

            e.preventDefault();
            switch ($(this).data('action')) {
                case 'save':

                    formulario.submit();
                    break;
            }
        });

    };

    /**
     * Manejador de los botones de accion de página
     */
    var handleActionsBuscador = function () {

        var formulario = $(pageID + '_Filter');
        var $filterTrigger = $('.stdAction[data-action="filter"]', pageID + '_Filter');

        formulario.off('click', '.stdAction').on('click', '.stdAction', function (e) {
            e.preventDefault();
            switch ($(this).data('action')) {

                case 'filter':
                    formulario.submit();
                    break;

            }
        });
    };

    /**
     * Inicializar el dataTable
     */
    var handleBuscador = function () {

        var formulario = $(pageID + '_Filter');
        var $filterTrigger = $('.stdAction[data-action="filter"]', pageID + '_Filter');


        handleActionsBuscador();

        formulario.validate({
            rules: {
                "buscador_asunto": {
                    required: true
                }
            },

            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    dataType: "json",
                    success : function (json, statusText) {
                        if (json.success) {
                            $('.data', form).html(json.content);
                        }
                    }

                });
            }
        });

    };


    /**
     * Inicializar el formulario
     */
    var handleForm = function () {

        var formulario = $(pageID + '_form');

        handleFormActions();
        handleBuscador();


        formulario.validate({
            rules: {
                "asunto": {
                    required: true
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

    };

    return handleForm();


}();
