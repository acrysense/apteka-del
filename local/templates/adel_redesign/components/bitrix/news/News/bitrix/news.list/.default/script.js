;(function ( $, window, document, undefined ) {

    var MsNewsLoader = function( options ){

        this.body                   = $('body');
        this.classContainerItem	    = '.list';
        this.classBtnShowNext       = '.showNext';
        this.animate                = {
            active  : true,
            class   : '.news-animate',
            duration : 1000
        };
        this.numShowItems           = Number(options['NUM_SHOW_ITEMS']);
        this.numOutput              = Number(options['NUM_OUTPUT']);
        this.ajaxPath	            = options['AJAX_PATH'];
        this.arParams	            = options;

        this.init();
    };

    MsNewsLoader.prototype = {

        init: function() {

            var self = this;

            $(document).ready(function(){

                self.body.on('click', self.classBtnShowNext, function(e){
                    self.get(this, 'Get');
                    e.preventDefault();
                });

            });

            return this;
        },

        get : function(elem, event) {

            var self = this;
            var data = [];

            data.event    = event;
            data.sessid   = BX.bitrix_sessid();
            data.arParams = self.arParams;
            data.arParams.NUM_SHOW_ITEMS = self.numShowItems;

            BX.ajax({
                url: self.ajaxPath,
                method: 'POST',
                dataType: 'json',
                data: data,
                onsuccess: function(data){

                    var htmlItem = '';
                    var items = data['ITEMS'];

                    for (var key in items) {
                        if(items.hasOwnProperty(key)){

                            htmlItem = self.getHtmlItem(
                                items[key]['DETAIL_PAGE_URL'],
                                self.setLimitText(items[key]['NAME'], 40),
                                self.setLimitText(items[key]['PREVIEW_TEXT'], 50),
                                items[key]['PREVIEW_PICTURE']['SRC']
                            );

                            $(self.classContainerItem).append(htmlItem);

                            if(self.animate.active){
                                $(self.animate.class).hide();
                                $(self.animate.class).show(self.animate.duration);
                                $(self.animate.class).removeClass();
                            }
                        }
                    }

                    self.numShowItems = self.numShowItems + self.numOutput;

                    if(self.numShowItems >= Number(data['COUNT']))
                        $(self.classBtnShowNext).hide();

                }
            });
        },

        getHtmlItem : function(url, name, text, picture) {

            var self = this;

            if(url === undefined)
                url = '#';
            if(name === undefined)
                name = '';
            if(text === undefined)
                text = '';
            if(picture === undefined)
                picture = '';

            var animateClass = '';
            if(self.animate.active)
                animateClass = self.animate.class.slice(1);

            return  '<li class="' + animateClass + '">' +
                '<a href="' + url + '" class="item" style="background-image:url(' + picture + ')">' +
                    '<span class="title">' +
                        '<span class="value ellipsis">' + name + '</span>' +
                        '<span class="annotate ellipsis">' + text + '</span>' +
                    '</span>' +
                '</a>' +
                '</li>';
        },

        setLimitText : function (text, limit) {

            var self = this;

            if(limit === undefined && !self.isNumeric(limit) && limit <= 0)
                return text;

            var cutText = text.slice(0, limit);
            if (cutText.length < text.length) {
                cutText += '...';
            }

            return cutText;
        },

        isNumeric : function(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }

    };

    window.MsNewsLoader = MsNewsLoader;

})( $, window, document, undefined );