;(function ( $, window, document, undefined ) {

    var MsNewsLoader = function( options ){

        this.body                   = $('body');
        this.idNewsContainer	    = '#MsNewsContainer';
        this.classRow               = '.line';
        this.classItem              = '.item';
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

                    var htmlRow = '';
                    var htmlItem = '';
                    var items = data['ITEMS'];

                    for (var key in items) {
                        if(items.hasOwnProperty(key)){

                            var lastRow = self.getLastRow();
                            var countElement = self.getCountElementInRow(lastRow);

                            htmlItem = self.getHtmlItem(
                                items[key]['DETAIL_PAGE_URL'],
                                self.setLimitText(items[key]['NAME'], 50),
                                self.setLimitText(items[key]['PREVIEW_TEXT'], 70),
                                items[key]['PREVIEW_PICTURE']['SRC']
                            );

                            if(countElement < self.numOutput){
                                $(lastRow).append(htmlItem);
                            }
                            else{

                                htmlRow = '<div class="line">';
                                htmlRow += htmlItem;
                                htmlRow += '</div>';
                                $(self.classBtnShowNext).before(htmlRow);

                            }

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

            return  '<div class="' + animateClass + '">' +
                        '<a href="' + url + '" class="item" style="background-image:url(' + picture + ')">' +
                            '<span class="title">' + name + '' +
                                '<span class="annotate">' + text + '</span>' +
                            '</span>' +
                        '</a>' +
                    '</div>';
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

        getLastRow : function() {
            var self = this;
            return $(self.idNewsContainer+' '+self.classRow).last();
        },

        getCountElementInRow : function(row) {
            var self = this;
            return $(row).find(self.classItem).length;
        },

        isNumeric : function(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }

    };

    window.MsNewsLoader = MsNewsLoader;

})( $, window, document, undefined );