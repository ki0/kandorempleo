(function ($){

    var myModelBox = Backbone.Model.extend({
        toString: function() { return this.get('slug'); }
    });

    var myColBox = Backbone.Collection.extend({
        model: myModelBox,
        url: '/wordpress/ofertas/master/?json=get_taxonomy&taxonomy=habilidad',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });

    var myColArtBox = Backbone.Collection.extend({
        model: myModelBox,
        url: '/wordpress/ofertas/master/?json=get_taxonomy&taxonomy=habilidad-artistica',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });

    var myColTechBox = Backbone.Collection.extend({
        model: myModelBox,
        url: '/wordpress/ofertas/master/?json=get_taxonomy&taxonomy=habilidad-tecnica',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });
    var myColSoftBox = Backbone.Collection.extend({
        model: myModelBox,
        url: '/wordpress/ofertas/master/?json=get_taxonomy&taxonomy=habilidad-software',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });

    var myColArtBoxes = new myColArtBox(); 
    myColArtBoxes.fetch();
    var myColTechBoxes = new myColTechBox(); 
    myColTechBoxes.fetch();
    var myColSoftBoxes = new myColSoftBox(); 
    myColSoftBoxes.fetch();
    var myColBoxes = new myColBox(); 
    myColBoxes.fetch();

    function validateEmail(str) {
        var regex = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        
        return regex.test(str) ? null : 'Invalid email';
    }
    
    var Form = Backbone.Model.extend({
        schema: {
            nombre:                 {},
            apellidos:              {},
            email:                  { type: 'Text', dataType: 'email', validators: ['required', validateEmail] },
            telefono:               { type: 'Text', dataType: 'tel', validators: ['required'] },
            nacionalidad:           { type: 'Select', options: ['Española', 'Extranjera'] },
            link1:                  { type: 'Text', title: 'Enlace a Reel', dataType: 'url' },
            link2:                  { type: 'Text', title: 'Enlace a Web/Blog', dataType: 'url' },
            comments:               { type: 'Text', title: 'Comentarios', dataType: 'url' },
            skills1:                { type: 'Checkboxes', title:' ', options: myColBoxes },
            skills2:                { type: 'Checkboxes', title:' ', options: myColArtBox },
            skills3:                { type: 'Checkboxes', title:' ', options: myColTechBox },
            skills4:                { type: 'Checkboxes', title:' ', options: myColSoftBox },
            skills5:                { type: 'List' },
        },
    });
    
    var List11 = new Form ({
        skills1: true,
    });

    var Step11View = Backbone.View.extend({
        id: 'step11',

        events: {
            'click #more': 'more',
            'click #hide': 'less',
            'click #next': 'next',
        },

        initialize: function (){
            _.bindAll(this, 'render', 'more', 'next', 'less');
            this.render();
        },

        render: function (){
            var form1 = new Backbone.Form({
                model: List11,
                fields: ['skills1']
            }).render();
            var form2 = new Backbone.Form({
                model: List11,
                fields: ['skills2']
            }).render();
            $(this.el).css('display', 'block');
            $(this.el).append(form1.el);
            $(this.el).append("<a id='more'>Show more</a><div id='show' style='display: none'>"+form2.$el.html()+"</div>");
            $(this.el).append("<br /><a id='next'>Next</a>");
            return this;
        },

        more: function (){
            $('#more').text('Hide more').attr('id', 'hide');
            $('#show').show();
        },

        less: function (){
            $('#hide').text('Show more').attr('id', 'more');
            $('#show').hide();
        },

        next: function (){
            $('#step1').hide();
            $('#step2').show();
            $('#modal-blanket').css({
                height: $(document).height(), // Span the full document height...
                width: "100%", // ...and full width
            });
        }

    });
    
    var List12 = new Form ();

            
    var Step12View = Backbone.View.extend({
        id: 'step12',

        events: {
            'click #more': 'more',
            'click #hide': 'less',
            'click #next': 'next',
        },

        initialize: function (){
            _.bindAll(this, 'render', 'more', 'next', 'less');
            this.render();
        },

        render: function (){
            var form2 = new Backbone.Form({
                model: List12,
                fields: ['skills2']
            }).render();
            var form3 = new Backbone.Form({
                model: List12,
                fields: ['skills3']
            }).render();
            var form4 = new Backbone.Form({
                model: List12,
                fields: ['skills4']
            }).render();
            $(this.el).css('display', 'block');
            $(this.el).append(form2.el);
            $(this.el).append(form3.el);
            $(this.el).append(form4.el);
            $(this.el).append("<br /><a id='next'>Next</a>");
            return this;
        },

        more: function (){
            $('#more').text('Hide more').attr('id', 'hide');
            $('#show').show();
        },

        less: function (){
            $('#hide').text('Show more').attr('id', 'more');
            $('#show').hide();
        },

        next: function (){
            $('#step1').hide();
            $('#step2').show();
            $('#modal-blanket').css({
                height: $(document).height(), // Span the full document height...
                width: "100%", // ...and full width
            });
        }

    });
            
    var List2 = new Form();

    var Step2View = Backbone.View.extend({
        id: 'step2',

        events: {
            'click #next2': 'next2',
        },

        initialize: function (){
            _.bindAll(this, 'render', 'next2');
            this.render();
        },
        
        render: function () {
            var form = new Backbone.Form({
                model: List2,
                fields: ['nombre', 'apellidos', 'email', 'nacionalidad', 'link1', 'link2']
            }).render();
            $(this.el).append(form.el);
            $(this.el).append("<input id='fileupload' type='file' name='files[]' multiple>");
            $('#fileupload').fileupload({
                dataType: 'json',
                maxNumberOfFiles: '1',
                forceIframeTransport: true,
                url: 'server/php/',
                acceptFileTypes: /\.(pdf|doc|docx)$/i,
                maxFileSize: '5000',
                send: function (e, data) {
                    if (data.files.length > 1) {
                        return false;
                    }
                    if (data.total > 50000) {
                        return false;
                    }
                    alert('File Upload has been canceled');
                },
                add: function (e, data) {
                    var jqXHR = data.submit()
                        .error(function (jqXHR, textStatus, errorThrown){
                            if (errorThrown === 'abort') {
                                alert('File Upload has been aborted');
                                jqXHR.abort();
                            }
                        });
                },
                done: function (e, data){
                }
            });
            $(this.el).append("<a id='next2'>Next</a>");
            return this;
        },

        next2: function (){
            $('#step2').hide();
            $('#step3').show();
            $('#modal-blanket').css({
                top: $(document).scrollTop(),
                height: $(document).height(), // Span the full document height...
                width: "100%", // ...and full width
                
            });
        }
    });

    
    var List3 = new Form();

    var Step3View = Backbone.View.extend( {
        id: 'step3',
        
        events: {
            'click #end': 'end',
        },

        initialize: function (){
            _.bindAll(this, 'render', 'end');
            this.render();
        },
        
        render: function () {
            var form = new Backbone.Form({
                model: List3,
                fields: ['comments']
            }).render();
            $(this.el).append("<p id='text31'>¡GRACIAS!");
            $(this.el).append("<p id='text32'> Ya tenemos toda la información necesaria para incluirle en nuestro proceso de selección.<br />");
            $(this.el).append("<p id='text33'> Si quieres añadir alguna cosa más como por ejemplo ejemplo1, ejemplo2, ejemplo3 introducelo a continuación o ve directamente al botón de finalizar.");
            $(this.el).append(form.el);
            $(this.el).append("<a id='end'>Ending</a>");
            return this;
        },

        end: function (){
            $('#step3').hide();
        }
        
    });

    ModalViewForm1 = ModalView.extend({
        
        initialize: function(){
            this.list11View = new Step11View();
            this.list11View.parentView = this;
            $(this.el).append(this.list11View.el);
            this.list2View = new Step2View();
            this.list2View.parentView = this;
            $(this.el).append(this.list2View.el);
            this.list3View = new Step3View();
            this.list3View.parentView = this;
            $(this.el).append(this.list3View.el);
        }
    });
    
    ModalViewForm2 = ModalView.extend({
        
        initialize: function(){
            this.list12View = new Step12View();
            this.list12View.parentView = this;
            $(this.el).append(this.list11View.el);
            this.list2View = new Step2View();
            this.list2View.parentView = this;
            $(this.el).append(this.list2View.el);
            this.list3View = new Step3View();
            this.list3View.parentView = this;
            $(this.el).append(this.list3View.el);
        }
    });

})(jQuery);
