v_Catalog={
    window_reserve_add:function (data) {

        console.info('data!!!', data);

        var count=data.count_cart;

        if(count) {
            if(count>0){
                $("#countBasket").show();
            }
            else{
                $("#countBasket").hide();
            }
            $("#countBasket").text(count);
        }

        $("#WinAdded .name a").text(data.name).attr('href', data.link);

        if(!data.picture){
            $("#WinAdded .img").html(data.default_picture);
        }
        else{
            $("#WinAdded .img").html('' +
                '<img src="'+data.picture+'">');
        }

        c_orderLine.updateInfo();
        OpenWin('WinAdded');
    },
    
    init_ajax_products:function () {
        $("#catalog_items_list").fadeOut(70, function(){
            $("#catalog_items_list").html('');
        });



    },

    setBtnToCart:function(element){
        $(element).fadeOut(300, function () {
            $(element).text('Уже в корзине').attr('data-incart', true).addClass('btn-red');
            $(element).fadeIn(300);

        });
    },

    show_ajax_products:function (data) {


        var items=data.items;




        if(items.length){
            $(".error-no-items").fadeOut(500, function(){ });
            for(var i=0; i<items.length; i++){
                var item=items[i];


                /*
                <div class="wrapper-item">
						<a href="<?=$item['DETAIL_PAGE_URL']?>" class="item">
							<div class="block-img">
								<img class="thumb" src="<?=$item['DETAIL_PICTURE']?>" alt="Шампунь">
							</div>
							<div class="block">
								<h2 class="name ellipsis"><?=$item['NAME']?>
								</h2>
								<div class="price stock-item">
<!--									<div class="old-price">5,60</div>-->
									<div class="new-price"><span class="black"><?=($item['PRICE']?$item['PRICE']:'--')?></span> руб.</div>
								</div>
							</div>
						</a>
						<div class="book">
                            <?if($item['PRICE']):?>
							<div class="btn-order btn_reserve_product" data-id="<?=$item['ID']?>" data-count="1">Бронировать</div>
							<?endif;?>
						</div>
					</div>
                 */

                var el_wrapper_item=document.createElement('div');
                $(el_wrapper_item).addClass('wrapper-item').attr('id', 'el_'+item.id).appendTo("#catalog_items_list");

                var el_product_link=document.createElement('a');
                $(el_product_link).addClass('item').attr('href', item.url).appendTo($(el_wrapper_item));

                var el_sale=document.createElement('div');
                $(el_sale).addClass('sale').appendTo($(el_product_link));

                if(item.hit){
                    var el_hit=document.createElement('div');
                    $(el_hit).addClass('hit').appendTo($(el_sale)).text('Хит');
                }

                if(item.promo){
                    var el_promo=document.createElement('div');
                    $(el_promo).addClass('stock').appendTo($(el_sale)).text('Акция');
                }

                var el_block_img=document.createElement('div');
                $(el_block_img).addClass('block-img').appendTo($(el_product_link));

                var el_thumb=document.createElement('img');
                $(el_thumb).attr('src', item.picture).appendTo($(el_block_img));

                var el_block=document.createElement('div');
                $(el_block).addClass('block').appendTo($(el_product_link));

                var el_h2=document.createElement('h2');
                $(el_h2).addClass('h2 name ellipsis').text(item.name).appendTo($(el_block));

                var el_block_price=document.createElement('div');

                var price_new;
                var el_new_price=document.createElement('div');




                var price2_classes='black';

                var not_show_second_price=false

                if(item.promo==1){
                    price_new=item.promo_price;
                    if(price_new==item.base_price){
                        not_show_second_price=true;
                    }

                    price2_classes+=' promo_price';
                }
                else{
                    price_new=item.disc_price;
                    if(price_new==item.base_price){
                        not_show_second_price=true;
                    }

                    price_new+='*';
                }



                if(!not_show_second_price){
                    $(el_new_price).addClass('new-price').html(
                        '<span class="'+price2_classes+'">'+price_new+'</span>'
                    ).appendTo($(el_block_price));
                }





                $(el_block_price).appendTo($(el_block)).addClass('price stock-item');

                var el_old_price=document.createElement('div');
                $(el_old_price).addClass('old-price').appendTo($(el_block_price));
                if(item.promo==1){
                    $(el_old_price).addClass('old_price_on_promo ');
                }

                $(el_old_price).text(item.base_price);

                $(el_block_price).append(' руб.');


                var el_book=document.createElement('div');

                $(el_book).addClass('book').appendTo($(el_wrapper_item));

                var textBook="Бронировать";
                var addClass='';
                if(item.in_basket){
                    textBook="Уже в корзине";
                    addClass='btn-red';
                }



                if(item.base_price>0.001){
                    $(el_book).html(
                        '<div class="btn-order btn_reserve_product '+addClass+'" data-id="'+item.id+'" data-incart="'+item.in_basket+'" data-count="1">'+textBook+'</div>'
                    );
                }




            }

            $("#catalog_items_list").fadeIn(500, function(){ });

            if(data.no_more==1){
                $("#show_more").hide();
            }
            else{
                $("#show_more").fadeIn(500, function(){ });
            }


        }
        else{
            $("#catalog_items_list").html('');
            $("#show_more").fadeOut(500, function(){ });
            $(".error-no-items").fadeIn(500, function(){ });
        }

    },

    updateCardPrices:function (price) {
        console.info('try to update class prices');
        if(price=='base'){
            console.info('base!');
            if(!$(".base_card_price").hasClass('no_calc')){
                $(".base_card_price").addClass('no_active_price');
                $(".old_price_card").removeClass('no_active_price');
            }

        }
        else{
            console.info('disc!');
            if(!$(".base_card_price").hasClass('no_calc')){
                $(".base_card_price").removeClass('no_active_price');
                $(".old_price_card").addClass('no_active_price');
            }



        }
    }


    
}