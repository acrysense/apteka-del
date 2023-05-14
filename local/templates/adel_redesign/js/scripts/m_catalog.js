m_Catalog={
    product_reserve: function (product_id, count, func) {

        $.get( "/ajax/catalog.php", {
            validation: 1,
            product: product_id,
            count: count,
            request: 'product_reserve'
        })
        .done(function( data ) {

            data=JSON.parse(data);
            func(data);
        });
    },
    
    basket_list: function () {//get all reserved products

    },
    
    get_ajaxList_params:function () {
        var page=UrlUtil.getParam('page');
        var section_id=$("#section_id").val();

        var recipe=UrlUtil.getParam('recipe');
        var brand=parseInt(UrlUtil.getParam('brand'));

        var sort=UrlUtil.getParam('sort');
        var order=UrlUtil.getParam('order');

        if(recipe===undefined){
            recipe=0;
        }
        if(brand===undefined){
            brand=0;
        }
        if(!(page>1)){
            page=1;
        }

        return {
            page: page,
            section:section_id,
            recipe: recipe,
            brand: brand,
            sort: sort,
            order: order
        };
    },
    
    get_ajax_products:function (section_id, page, recipe, brand, sort, order, page_from, func) {


        console.info({
            validation: 1,
            section: section_id,
            page: page,
            request: 'get_items',
            recipe: recipe,
            brand: brand,
            sort: sort,
            order: order,
            page_from: page_from
        });

        $.get( "/ajax/catalog.php", {
            validation: 1,
            section: section_id,
            page: page,
            request: 'get_items',
            recipe: recipe,
            brand: brand,
            sort: sort,
            order: order,
            page_from:page_from
        })
            .done(function( data ) {


                data=JSON.parse(data);

                func(data);
            });
    },

    set_page:function (page) {
        UrlUtil.setUrl(
            {
                page: page
            },
            ['page']
        );
    },

    update_product:function (productID, productCount, func) {
        $.get( "/ajax/catalog.php", {
            validation: 1,
            product: productID,
            count: productCount,
            request: 'update_product_count'
        })
            .done(function( data ) {
                data=JSON.parse(data);

                c_orderLine.updateInfo(func);
            });
    }


}