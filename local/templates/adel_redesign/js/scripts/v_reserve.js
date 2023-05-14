v_Reserve={
    basket_delete_line:function (line_id) {

        var basketCount=parseInt($("#countBasket").text());

        console.info('----');
        console.info(basketCount);

        if(basketCount>1){
            basketCount--;
            $("#countBasket").text(basketCount);
        }
        else{
            $("#countBasket").hide();
        }

        $(".block-orders .orders_id_"+line_id).slideUp("slow", function() {
            $(".block-orders .orders_id_"+line_id).remove();
            v_Reserve.basket_recalc();
        });

        //
        // $(".block-orders .orders_id_"+line_id).remove();

    },

    basket_update_count:function (id) {
        var price= $("#order_basket_"+id+" .red-price").attr('data-price');
        var count= $("#order_basket_"+id+" .product_reserve_count").val();
        
    },
    
    basket_recalc:function () {


        var el_orders=$(".orders");

        //first, calculate total summ
        var total_base=0;
        var total_discount=0;
        for(var i=0; i<$(el_orders).length; i++){

            var active=parseInt(
                $(el_orders[i]).attr('data-active')
            );

            if(active==0){
                continue;
            }


            var is_promo=($(el_orders[i]).hasClass('order_promo')?1:0);
            console.info('is_promo', is_promo);

            var count=$(el_orders[i]).find('.product_reserve_count').val();

            var item_total_base=parseFloat(
                ($(el_orders[i]).attr('data-price_base')*count).toFixed(2)
            );
            var item_total_disount=parseFloat(
                ($(el_orders[i]).attr('data-price_discount')*count).toFixed(2)
            );


            if(is_promo==1){
                total_base+=item_total_disount;
            }
            else{
                total_base+=item_total_base;
            }


            total_discount+=item_total_disount;

            $(el_orders[i]).find('.reserve_price_1 .price_number').text(item_total_base)
            $(el_orders[i]).find('.reserve_price_2 .price_number').text(item_total_disount)
        }

        if(total_base<$("#order_min_summ").val()){
            $("#btn_reserve_next").fadeOut(1000);
            $(".min-price-error").fadeIn(1000);

        }
        else{
            $("#btn_reserve_next").fadeIn(1000);
            $(".min-price-error").fadeOut(1000);
        }


        c_orderLine.setCurrentPrice(total_base);

        if(total_base==0){
            location.href='/catalog/'
        }




       var total_limit=parseFloat($("#reserve_total").attr('data-discount_limit'));

        var style='base';
        if(total_base>total_limit){
            style='discount';
        }

        $("#reserve_total_discount .total_number").text(total_discount.toFixed(2));
        $("#reserve_total_base .total_number").text(total_base.toFixed(2));




        if(total_base-$("#order_min_summ").val()>=0){
            $("#reserve_min_left_block").slideUp(1000);
        }
        else{
            $("#reserve_min_left_block").slideDown(1000);
        }
        $("#reserve_min_left b").text(($("#order_min_summ").val()-total_base).toFixed(2));

        if(style=='base'){
            var remain=total_limit-total_base;

            $("#reserve_left b").text(remain.toFixed(2));

            $("#reserve_left_block span").show()
            $("#you-saved_container").hide()
            $("#reserve_total_base").addClass('red-price').removeClass('old-price').removeClass('linethr');
            $("#reserve_total_discount").addClass('old-price').removeClass('red-price');
            $(".orders .reserve_price_1").addClass('red-price').removeClass('old-price').removeClass('linethr');
            $(".orders .reserve_price_2").addClass('old-price').removeClass('red-price');
        }
        else{
            $("#reserve_left_block span").hide()

            var price=(parseFloat($("#reserve_total_base .total_number").text())-parseFloat($("#reserve_total_discount .total_number").text())).toFixed(2);

            $("#you-saved_container span").text(price);

            $("#you-saved_container").show();
            $("#reserve_total_base").removeClass('red-price').addClass('old-price').addClass('linethr')
            $("#reserve_total_discount").removeClass('old-price').addClass('red-price')
            $(".orders .reserve_price_1").removeClass('red-price').addClass('old-price').addClass('linethr');
            $(".orders .reserve_price_2").removeClass('old-price').addClass('red-price');
        }

    }
}