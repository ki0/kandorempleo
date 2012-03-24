(function ($){
    
    var myArtBox = Backbone.Model.extend({
        toString: function() { return this.get('title'); }
    });

    var myTecBox = Backbone.Model.extend({
        toString: function() { return this.get('title'); }
    });

    var mySofBox = Backbone.Model.extend({
        toString: function() { return this.get('title'); }
    });    
    
    var myColArtBox = Backbone.Collection.extend({
        model: myArtBox,
        url: '/wordpress/?json=get_taxonomies_index&taxonomy=habilidad-artistica',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  title: item.title
              };
            }); 
        }
    });

    var myColTecBox = Backbone.Collection.extend({
        model: myTecBox,
        url: '/wordpress/?json=get_taxonomies_index&taxonomy=habilidad-tecnica',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  title: item.title
              };
            }); 
        }
    });

    var myColSofBox = Backbone.Collection.extend({
        model: mySofBox,
        url: '/wordpress/?json=get_taxonomies_index&taxonomy=habilidad-software',
        parse: function (resp) {
            return _.map( resp.terms, function( item ){
              return {
                  id: item.id,
                  title: item.title
              };
            }); 
        }
    });
    var myArtBoxes = new myColArtBox(); 
    myArtBoxes.fetch();
    var myTecBoxes = new myColTecBox(); 
    myTecBoxes.fetch();
    var mySofBoxes = new myColSofBox(); 
    mySofBoxes.fetch();
    
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
            comments:               { type: 'TextArea', title: 'Comentarios', dataType: 'url' },
            skills1:                { type: 'Checkboxes', title:' ', options: myArtBoxes },
            skills2:                { type: 'Checkboxes', title:' ', options: myTecBoxes },
            skills3:                { type: 'Checkboxes', title:' ', options: mySofBoxes },
            skills4:                { type: 'List' },
        },
    });
    
    var List = new Form ();

    var Step1View = Backbone.View.extend({
        id: 'step1',

        events: {
            'click #next': 'next',
        },

        initialize: function (){
            _.bindAll(this, 'render', 'next');
            console.log(List.attributes);
            this.render();
        },

        render: function (){
            var form1 = new Backbone.Form({
                model: List,
                fields: ['skills1']
            }).render();
            $(this.el).append("<p id='text29'>Hola, gracias por querer formar parte de nuestro equipo.");
			$(this.el).append("<p id='text30'>A continuación te mostramos una <strong>lista de habilidades</strong>, por favor <strong>selecciona las que se ajusten a tu perfil profesional:</strong>");
            var form2 = new Backbone.Form({
                model: List,
                fields: ['skills2']
            }).render();
            var form3 = new Backbone.Form({
                model: List,
                fields: ['skills3']
            }).render();
            $(this.el).append(form1.el);
			$(this.el).append(form2.el);
            $(this.el).append(form3.el);
            $(this.el).append("<br/><a id='next' class='nice radius blue button'>PASO 2</a>");
            return this;
        },

        next: function (){
	        $('html, body').animate({ scrollTop: 0 }, 'slow');
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
            $(this.el).append("<p id='text36'> Por favor rellena el siguiente formulario para que podamos contactar contigo:<br/>");
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
            $(this.el).append("<a id='next2' class='nice radius blue button'>PASO 3</a>");
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
            $(this.el).append("<p id='text31'><strong>¡Muchas gracias por tu interés en formar parte del Equipo KANDOR Graphics!</strong>");
            $(this.el).append("<p id='text32'> Ya tenemos toda la información necesaria para incluirte en nuestro proceso de selección. Será valorada por el Director de Departamento y estaremos encantados de contactar contigo, en caso de que seas preseleccionado. <br/>");
            $(this.el).append("<p id='text33'> Si quieres añadir alguna cosa más, como una <strong>carta de presentación, recomendaciones o referencias...</strong> introdúcelo a continuación o ve directamente al botón de finalizar.");
            $(this.el).append(form.el);
            $(this.el).append("<a id='end' class='nice radius blue button'>FINALIZAR</a>");
            return this;
        },

        end: function (){
            $('#step3').hide();
            console.log(this);
            $('#modalContainer').hide();
        }
    });

    ModalFormView2 = ModalView.extend({
        
        initialize: function(){
            this.list1View = new Step1View();
            this.list1View.parentView = this;
            $(this.el).append(this.list1View.el);
            this.list2View = new Step2View();
            this.list2View.parentView = this;
            $(this.el).append(this.list2View.el);
            this.list3View = new Step3View();
            this.list3View.parentView = this;
            $(this.el).append(this.list3View.el);
        }
    });

})(jQuery);
