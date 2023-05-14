m_Reserve={
    step_1:function (e) {
        $('<form action="" method="POST">' +
            '<input type="hidden" name="step" value="1">' +
            '</form>').appendTo(document.body).submit();


    },

    step_2:function (e) {

        $('<form action="" method="POST">' +
            '<input type="hidden" name="step" value="2">' +
            '</form>').appendTo(document.body).submit();


    },

    delete_from_basket:function (id, func) {
        $.get( "/ajax/catalog.php", {
            validation: 1,
            basket: id,
            request: 'delete_from_basket'
        })
            .done(function( data ) {


                func(id);
            });
    },

    update_basket_item:function (id, count, func) {

        $.get( "/ajax/catalog.php", {
            validation: 1,
            basket: id,
            count: count,
            request: 'update_basket_item'
        })
            .done(function( data ) {

                func(id);
            });
    }
}