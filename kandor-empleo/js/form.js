(function ($){
    
    var mmyBox = Backbone.Model.extend({
        toString: function() { return this.get('slug'); }
    });

    var mourBox = Backbone.Model.extend({
        toString: function() { return this.get('slug'); }
    });

    var cmyBox = Backbone.Collection.extend({
        model: mmyBox,
        url: 'http://localhost/kandor/empleo/producction-coordinator/?json=get_taxonomy&taxonomy=habilidad',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });

    var courBox = Backbone.Collection.extend({
        model: mourBox,
        url: 'http://localhost/kandor/empleo/?json=get_taxonomies_index&taxonomy=habilidad',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  slug: item.slug
              };
            }); 
        }
    });

    var cmyBoxes = new cmyBox(); 
    cmyBoxes.fetch();
    var courBoxes = new courBox(); 
    courBoxes.fetch();

    function validateEmail(str) {
        var regex = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        
        return regex.test(str) ? null : 'Invalid email';
    }
    
    var Form = Backbone.Model.extend({
        schema: {
            id:                     {},
            nombre:                 {},
            apellidos:              {},
            email:                  { type: 'Text', dataType: 'email', validators: ['required', validateEmail] },
            telefono:               { type: 'Text', dataType: 'tel', validators: ['required'] },
            nacionalidad:           { type: 'Select', options: ['Española', 'Extranjera'] },
            link1:                  { type: 'Text', title: 'Enlace a Reel', dataType: 'url' },
            link2:                  { type: 'Text', title: 'Enlace a Web/Blog', dataType: 'url' },
            comments:               { type: 'Text', title: 'Comentarios', dataType: 'url' },
            skills1:                { type: 'Checkboxes', options: cmyBoxes },
            skills2:                { type: 'Checkboxes', options: courBoxes },
            skills3:                { type: 'List' },
        },

        defaults: {
            skills1:                { type: 'Checkboxes', options: cmyBoxes }
        }
    });
    
    var List = new Form ();

    var Step1View = Backbone.View.extend({
        el: 'body',

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
                model: List,
                fields: ['skills1']
            }).render();
            var form2 = new Backbone.Form({
                model: List,
                fields: ['skills2']
            }).render();
            this.$el.append("<div id='step1' style='display: block'>");
            $('#step1').append(form1.el);
            $('#step1').append("<a id='more'>Show more</a>");
            $('#step1').append("<div id='show' style='display: none'>Div12</div>");
            $('#show').append(form2.el);
            $('#step1').append("<a id='next'>Next</a>");
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
        }

    });
            
    var List2 = new Form({
        
    });

    var Step2View = Backbone.View.extend({
        el: 'body',

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
            this.$el.append("<div id='step2' style='display: none'>");
            $('#step2').append(form.el);
            $('#step2').append("<input id='fileupload' type='file' name='files[]' multiple>");
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
            $('#step2').append("<a id='next2'>Next</a>");
            return this;
        },

        next2: function (){
            $('#step2').hide();
            $('#step3').show();
        }
    });

    
    var List3 = new Form({
        
    });

    var Step3View = Backbone.View.extend( {
        el: 'body',
        
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
            this.$el.append("<div id='step3' style='display: none'>");
            $('#step3').append("<p id='text31'>¡GRACIAS!");
            $('#text31').append("<p id='text32'> Ya tenemos toda la información necesaria para incluirle en nuestro proceso de selección.<br />");
            $('#text32').append("<p id='text33'> Si quieres añadir alguna cosa más como por ejemplo ejemplo1, ejemplo2, ejemplo3 introducelo a continuación o ve directamente al botón de finalizar.");
            $('#step3').append(form.el);
            $('#step3').append("<a id='end'>Ending</a>");
            return this;
        },

        end: function (){
            $('#step3').hide();
        }
        
    });

    var list1View = new Step1View();
    var list2View = new Step2View();
    var list3View = new Step3View();
})(jQuery);
