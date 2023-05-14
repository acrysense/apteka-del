c_Catalog={
    init:function(page){
        c_Catalog.catalogPage=page;
    },

    check_click: function () {

        // $( ".btn_reserve_product" ).on( "click", function() {
        //     alert('reserve');
        // });

        $('body').on('click', '.btn_reserve_product', function() {

            console.info('test2');

            var inCart=$(this).attr('data-incart');

            console.info(inCart);


            if(inCart=='true'){
                location.href='https://apteka-adel.by/personal/reserve/';
            }
            else{
                var productId=$(this).attr('data-id');
                var productCount=$(this).attr('data-count');

                m_Catalog.product_reserve(
                    productId, productCount, v_Catalog.window_reserve_add
                );
                v_Catalog.setBtnToCart(this);




            }




        });




        $("div, a, span, button, input").click(function (e) {

            if($(this).hasClass( "btn_reserve" )){
                
            }

            if($(this).hasClass( "item_sort_arrow" )){


                setTimeout(function () {
                    var strSort=$("#form_sort").val();
                    var mode=strSort.split('-')[0];

                    var orderStr=strSort.split('-')[1];

                    var order='asc';
                    if(orderStr=='down'){
                        order='desc';
                    }

                    console.info('------');

                    UrlUtil.setUrl({
                        sort: mode,
                        order: order

                    },
                        ['sort', 'order']);

                    v_Catalog.init_ajax_products();
                    c_Catalog.init_ajax_list();
                }, 300);



            }





            // if($(this).hasClass( "sort_arrow" )){
            //     alert('click!');
            // }

            // if($(this).hasClass( "btn_reserve_product" )){
            //     var productId=$(this).attr('data-id');
            //     var productCount=$(this).attr('data-count');
            //
            //     m_Catalog.product_reserve(
            //         productId, productCount, v_Catalog.window_reserve_add
            //     );
            // }

            if($(this).hasClass( "btn_reserve_product_single" )){
                console.info('test1');
                var inCart=$(this).attr('data-incart');

                if(inCart=='true'){
                    location.href='https://apteka-adel.by/personal/reserve/';

                }
                else{
                    var productId=$(this).attr('data-id');
                    var productCount=$("#product_counter_"+productId).val();
                    m_Catalog.product_reserve(
                        productId, productCount, v_Catalog.window_reserve_add
                    );
                    v_Catalog.setBtnToCart(".btn_reserve_product_single");
                }

            }


            switch ($(this).attr('id')){
                case 'btn_go_cart':
                    location.href='/personal/reserve/';
                    break;

                case 'btn_return_reserve':
                    CloseWin('WinAdded')
                    break;

                case 'show_more':




                    c_Catalog.catalogPage++;

                    UrlUtil.setUrl(
                        {
                            page: c_Catalog.catalogPage
                        }
                    );


                    //m_Catalog.set_page(c_Catalog.catalogPage);
                    c_Catalog.init_ajax_list();







                    break;

                case 'check-rec':

                    if($("#check-rec").prop('checked')){
                        UrlUtil.setUrl({
                                recipe: 1
                            },
                            ['recipe']
                        )
                    }
                    else{
                        UrlUtil.setUrl({
                                recipe: 0
                            },
                            ['recipe']
                        )
                    }

                    v_Catalog.init_ajax_products();

                    c_Catalog.init_ajax_list();



                    break;

                case 'check-norec':

                    if($("#check-norec").prop('checked')){
                        UrlUtil.setUrl({
                                recipe: -1
                            },
                            ['recipe']
                        )

                    }
                    else{
                        UrlUtil.setUrl({
                                recipe: 0
                            },
                            ['recipe']
                        )
                    }

                    v_Catalog.init_ajax_products();

                    c_Catalog.init_ajax_list();

                    break;


            }








        });
    },

    init_ajax_list:function (page_from) {

        var ajaxParams=m_Catalog.get_ajaxList_params();


        history.pushState(m_Catalog.get_ajaxList_params(), 'Каталог', window.location.href);

        m_Catalog.get_ajax_products(
            ajaxParams.section, c_Catalog.catalogPage,
            ajaxParams.recipe, ajaxParams.brand,
            ajaxParams.sort, ajaxParams.order,
            page_from,
            v_Catalog.show_ajax_products
        );
    },

    check_change:function () {


        // $("#form_sort").on('change', function(){
        //     console.info('change1111');
        // });

        $("div, input, select").change(function () {
            var el_id=$(this).attr('id');

            switch(el_id){
                case 'price_sort_el':
                case 'price_sort_el2':

                    var data_sort=$("#price_sort_el .active").attr('data-sort');

                    alert(data_sort);
                    break;

                case 'select_search_brands':
                    UrlUtil.setUrl(
                        {
                            brand: $(this).val()
                        },
                        ['brand']
                    );
                    v_Catalog.init_ajax_products();
                    c_Catalog.init_ajax_list();
                    break;

                // case 'form_sort':
                //     alert('change');
                //     console.info(
                //         $(this).val()
                //     );
                //     break;
            }
        })
    },
    
    updateProductCount:function (element) {


        var inCart=$(".btn_reserve_product_single").attr('data-incart');

        if(inCart){
            var id=$(element).attr('data-id');
            var count=$(element).val();

            if(count>1){

            }
            else{
                count=1;
            }

            m_Catalog.update_product(id, count, true);



            //c_Catalog.updateCard();



        }



    },

    updateCard:function () {

        var price;
        // var currentSum=data;
        // var discSumm=parseInt($("#order_disc_summ").val());

        if(parseInt($("#card_is_promo").val())==1){
            price='discount';
        }
        else{
            if(parseInt($("#order-progress-container .order-progress").attr('data-val'))>=100){
                price='discount';
            }
            else{
                price='base';
            }
        }



        v_Catalog.updateCardPrices(price);


    },

    checkBasketChanges:function () {



        var newVal=$("#order-progress-container .order-progress").attr('data-val');
        if(this.oldVal!=newVal){
            c_Catalog.updateCard();
        }

        this.oldVal=newVal;

    }


}