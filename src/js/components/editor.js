(function ($) {

    $(document).ready(function () {

        var editor = grapesjs.init({

            container: '#gjs',

            fromElement: true,

            height: '500px',
            width: 'auto',
            // canvas: {
            //     styles: wpPopup.editorStyles
            // },

            // storageManager: {
            //
            //     id: `gjs-popup-${wpPopup.popupId}`,
            //     type: 'remote',
            //     autosave: true,
            //     autoload: true,
            //     stepsBeforeSave: 1,
            //     storeComponents: true,
            //     storeStyles: true,
            //     storeHtml: true,
            //     storeCss: true,
            //     urlStore: wpPopup.storeUrl,
            //     urlLoad: wpPopup.loadUrl,
            //     params: {},
            //     headers: {},
            // },

            plugins: ['gjs-preset-webpage'],

        });

        //Add Settings Trait to the style manager tab
        var pn = editor.Panels;

        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);

        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        var traitsSector = $('<div class="gjs-sm-sector no-select">' +
            '<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Setting </div>' +
            '<div class="gjs-sm-properties" style="display: none;"></div></div>');

        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));

        $('.gjs-sm-sectors').before(traitsSector);

        traitsSector.find('.gjs-sm-title').on('click', function () {
            var traitStyle = traitsProps.get(0).style;
            var hidden = traitStyle.display == 'none';
            if (hidden) {
                traitStyle.display = 'block';
            } else {
                traitStyle.display = 'none';
            }
        });


        //Add Video trait
        var domComps = editor.DomComponents;

        var dType = domComps.getType('video');
        var dModel = dType.model;
        var dView = dType.view;

        domComps.addType('video', {
            model: dModel.extend(
                {
                    init() {
                        dModel.prototype.init.apply(this, arguments);
                        this.listenTo(this, 'change:provider', this.updateTypeTraits);
                        var typeTrait = this.get('traits').find(el => el.get('name') == 'type');
                        if (!typeTrait) {
                            typeTrait = this.get('traits').add({
                                type: 'select',
                                label: 'Data',
                                name: 'type',
                                options: ['myoptions'],
                                changeProp: 1,
                            });
                        }
                    },

                    updateTraits() {
                        var prov = this.get('provider');
                        var traits = this.getSourceTraits();

                        switch (prov) {
                            case 'yt':
                            case 'ytnc':
                                this.set('tagName', 'iframe');
                                traits = this.getYoutubeTraits();
                                break;
                            case 'vi':
                                this.set('tagName', 'iframe');
                                traits = this.getVimeoTraits();
                                break;
                            default:
                                this.set('tagName', 'video');
                        }

                        traits.push({
                            type: 'select',
                            label: 'Data',
                            name: 'type',
                            options: ['myoptions'],
                            changeProp: 1,
                        });

                        this.loadTraits(traits);

                        this.em.trigger('component:toggled');
                    },
                }),
            view: dView,
        });


    });

})(jQuery);