c_Reserve={
    check_click: function () {


        $("div, a, span, button").click(function (e) {


            if($(this).hasClass( "btn_step_go" )){



                var step=parseFloat($(this).attr('data-step'));

                switch (step){
                    case 1:
                        m_Reserve.step_1();
                        break;

                    case 2:
                        m_Reserve.step_2();
                        break;

                }

                e.preventDefault();

            }


            if($(this).hasClass( "btn_basket_del" )){


                var productID=$(this).attr('data-basket');
                m_Reserve.delete_from_basket(productID, v_Reserve.basket_delete_line);
                e.preventDefault();
                return;

            }

            if($(this).hasClass('btn_product_counter')){

                console.info('click');

                var element=$(this).parent().find(".product_reserve_count");
                var basketCount=$(element).val();
                if($(this).hasClass('btn_product_counter_minus')){
                    basketCount--;
                }
                else{
                    basketCount++;
                }


                var basketID=$(element).attr('data-basket');
                // console.info('test1');
                // m_Reserve.update_basket_item(basketID, basketCount, v_Reserve.basket_recalc);




            }





        });


    },

    check_keydown:function () {
        $("input").keydown(function (e) {

            if($(this).hasClass("product_reserve_count")){

                if(e.which==13){

                    var basketCount=$(this).val();
                    var basketID=$(this).attr('data-basket');
                    console.info('test2');
                    m_Reserve.update_basket_item(basketID, basketCount, v_Reserve.basket_recalc);
                    e.preventDefault();

                }

                if ($.inArray(e.keyCode, [13, 46, 8, 9, 27, 13, 110]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }

                if(e.which==13){

                    var basketCount=$(this).val();
                    var basketID=$(this).attr('data-basket');
                    console.info('test3');
                    m_Reserve.update_basket_item(basketID, basketCount, v_Reserve.basket_recalc);
                    e.preventDefault();

                }

            }

        });
    },

    check_change:function () {
        // $("select").change(function (e) {
        //
        //     var el_id=$(this).attr('id');
        //
        //     switch(el_id){
        //         case 'selectRegionPharm':
        //             c_Pharmacy.filter();
        //             break;
        //     }
        // })


        
        $("input").change(function (e) {

            if($(this).hasClass('product_reserve_count')){


                var basketCount=$(this).val();
                var basketID=$(this).attr('data-basket');

                console.info('test4');
                m_Reserve.update_basket_item(basketID, basketCount, v_Reserve.basket_recalc);
                e.preventDefault();
            }
        });
    }

}