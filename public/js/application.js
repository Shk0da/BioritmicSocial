var $input = $('<div class="modal-body"><textarea class="form-control" data-autosize-on="true" placeholder="Сообщение" name="message"></textarea></div>');
$(document).on("click", ".js-msgGroup", function () {
    $(".js-msgGroup, .js-newMsg").addClass("hide"), $(".js-conversation").removeClass("hide"), $(".modal-title").html('<a href="#" class="js-gotoMsgs">Назад</a>'), $input.insertBefore(".js-modalBody")
}), $(function () {
    function o() {
        return $(window).width() - ($('[data-toggle="popover"]').offset().left + $('[data-toggle="popover"]').outerWidth())
    }

    $(window).on("resize", function () {
        var t = $('[data-toggle="popover"]').data("bs.popover");
        t && (t.options.viewport.padding = o())
    }), $('[data-toggle="popover"]').popover({
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
        title: "",
        html: !0,
        trigger: "manual",
        placement: "bottom",
        viewport: {selector: "body", padding: o()},
        content: function () {
            var o = $(".app-navbar .navbar-nav:last-child").clone();
            return '<div class="nav nav-stacked" style="width: 200px">' + o.html() + "</div>"
        }
    }), $('[data-toggle="popover"]').on("click", function (o) {
        o.stopPropagation(), $('[data-toggle="popover"]').data("bs.popover").tip().hasClass("in") ? ($('[data-toggle="popover"]').popover("hide"), $(document).off("click.app.popover")) : ($('[data-toggle="popover"]').popover("show"), setTimeout(function () {
            $(document).one("click.app.popover", function () {
                $('[data-toggle="popover"]').popover("hide")
            })
        }, 1))
    })
}), $(document).on("click", ".js-gotoMsgs", function () {
    $input.remove(), $(".js-conversation").addClass("hide"), $(".js-msgGroup, .js-newMsg").removeClass("hide"), $(".modal-title").html("Сообщения")
}), $(document).on("click", "[data-action=growl]", function (o) {
    o.preventDefault(), $("#app-growl").append('<div class="alert alert-dark alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p>Click the x on the upper right to dismiss this little thing. Or click growl again to show more growls.</p></div>')
}), $(document).on("focus", '[data-action="grow"]', function () {
    $(window).width() > 1e3 && $(this).animate({width: 300})
}), $(document).on("blur", '[data-action="grow"]', function () {
    if ($(window).width() > 1e3) {
        $(this).animate({width: 180})
    }
}), $(function () {
    function o() {
        $(window).scrollTop() > $(window).height() ? $(".docs-top").fadeIn() : $(".docs-top").fadeOut()
    }

    $(".docs-top").length && (o(), $(window).on("scroll", o))
}), $(function () {
    function o() {
        i.width() > 768 ? e() : t()
    }

    function t() {
        i.off("resize.theme.nav"), i.off("scroll.theme.nav"), n.css({position: "", left: "", top: ""})
    }

    function e() {
        function o() {
            e.containerTop = $(".docs-content").offset().top - 40, e.containerRight = $(".docs-content").offset().left + $(".docs-content").width() + 45, t()
        }

        function t() {
            var o = i.scrollTop(), t = Math.max(o - e.containerTop, 0);
            return t ? void n.css({
                position: "fixed",
                left: e.containerRight,
                top: 40
            }) : ($(n.find("li")[1]).addClass("active"), n.css({position: "", left: "", top: ""}))
        }

        var e = {};
        o(), $(window).on("resize.theme.nav", o).on("scroll.theme.nav", t), $("body").scrollspy({
            target: "#markdown-toc",
            selector: "li > a"
        }), setTimeout(function () {
            $("body").scrollspy("refresh")
        }, 1e3)
    }

    var n = $("#markdown-toc"), i = $(window);
    n[0] && (o(), i.on("resize", o))
});

var newMsg = $('.js-newMsg');
var newMsgBlock = $('.new-message');
var Dialogs = $('.js-Dialogs');
var DialogsTitle = $('.js-DialogsTitle');
var backMsg = $('.js-backMsg');
var sendMsg = $('.js-sendMsg');

newMsg.on('click', function(){
    newMsgBlock.show();
    newMsg.hide();
    Dialogs.hide();
    DialogsTitle.hide();
});

backMsg.on('click', function(){
    newMsgBlock.hide();
    newMsg.show();
    Dialogs.show();
    DialogsTitle.show();
});

sendMsg.on('click', function(){

});

$('#save_background').hide();
$('#background').change(function() {
    var input = $(this)[0];
    if ( input.files && input.files[0] ) {
        if ( input.files[0].type.match('image.*') ) {
            var reader = new FileReader();
            reader.onload = function(e) { $('#background_preview').attr('src', e.target.result); }
            reader.readAsDataURL(input.files[0]);
            $('#save_background').show();
        } else console.log('is not image mime type');
    } else console.log('not isset files data or files API not supordet');
});

$('#save_add_photo').hide();
$('#photo_preview').hide();
$('#add_photo').change(function() {
    var input = $(this)[0];
    if ( input.files && input.files[0] ) {
        if ( input.files[0].type.match('image.*') ) {
            var reader = new FileReader();
            reader.onload = function(e) { $('#photo_preview').attr('src', e.target.result); }
            reader.readAsDataURL(input.files[0]);
            $('#photo_preview').show();
            $('#save_add_photo').show();
        } else console.log('is not image mime type');
    } else console.log('not isset files data or files API not supordet');
});

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        factory(jQuery);
    }
})(function ($) {

    'use strict';

    var console = window.console || { log: function () {} };

    function CropAvatar($element) {
        this.$container = $element;

        this.$avatarView = this.$container.find('.avatar-view');
        this.$avatar = this.$avatarView.find('img');
        this.$avatarModal = this.$container.find('#avatar-modal');
        this.$loading = this.$container.find('.loading');

        this.$avatarForm = this.$avatarModal.find('.avatar-form');
        this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
        this.$avatarSrc = this.$avatarForm.find('.avatar-src');
        this.$avatarData = this.$avatarForm.find('.avatar-data');
        this.$avatarInput = this.$avatarForm.find('.avatar-input');
        this.$avatarSave = this.$avatarForm.find('.avatar-save');
        this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

        this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
        this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

        this.init();
    }

    CropAvatar.prototype = {
        constructor: CropAvatar,

        support: {
            fileList: !!$('<input type="file">').prop('files'),
            blobURLs: !!window.URL && URL.createObjectURL,
            formData: !!window.FormData
        },

        init: function () {
            this.support.datauri = this.support.fileList && this.support.blobURLs;

            if (!this.support.formData) {
                this.initIframe();
            }

            this.initTooltip();
            this.initModal();
            this.addListener();
        },

        addListener: function () {
            this.$avatarView.on('click', $.proxy(this.click, this));
            this.$avatarInput.on('change', $.proxy(this.change, this));
            this.$avatarForm.on('submit', $.proxy(this.submit, this));
            this.$avatarBtns.on('click', $.proxy(this.rotate, this));
        },

        initTooltip: function () {
            this.$avatarView.tooltip({
                placement: 'bottom'
            });
        },

        initModal: function () {
            this.$avatarModal.modal({
                show: false
            });
        },

        initPreview: function () {
            var url = this.$avatar.attr('src');
            //this.$avatarWrapper.html('<img src="' + url + '_original">');
            this.$avatarPreview.html('<img src="' + url + '">');
        },

        initIframe: function () {
            var target = 'upload-iframe-' + (new Date()).getTime();
            var $iframe = $('<iframe>').attr({
                name: target,
                src: ''
            });
            var _this = this;

            // Ready ifrmae
            $iframe.one('load', function () {

                // respond response
                $iframe.on('load', function () {
                    var data;

                    try {
                        data = $(this).contents().find('body').text();
                    } catch (e) {
                        console.log(e.message);
                    }

                    if (data) {
                        try {
                            data = $.parseJSON(data);
                        } catch (e) {
                            console.log(e.message);
                        }

                        _this.submitDone(data);
                    } else {
                        _this.submitFail('Image upload failed!');
                    }

                    _this.submitEnd();

                });
            });

            this.$iframe = $iframe;
            this.$avatarForm.attr('target', target).after($iframe.hide());
        },

        click: function () {
            this.$avatarModal.modal('show');
            this.initPreview();
        },

        change: function () {
            var files;
            var file;

            if (this.support.datauri) {
                files = this.$avatarInput.prop('files');

                if (files.length > 0) {
                    file = files[0];

                    if (this.isImageFile(file)) {
                        if (this.url) {
                            URL.revokeObjectURL(this.url); // Revoke the old one
                        }

                        this.url = URL.createObjectURL(file);
                        this.startCropper();
                    }
                }
            } else {
                file = this.$avatarInput.val();

                if (this.isImageFile(file)) {
                    this.syncUpload();
                }
            }
        },

        //submit: function () {
        //    if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        //        return false;
        //    }
        //
        //    if (this.support.formData) {
        //        this.ajaxUpload();
        //        return false;
        //    }
        //},

        rotate: function (e) {
            var data;

            if (this.active) {
                data = $(e.target).data();

                if (data.method) {
                    this.$img.cropper(data.method, data.option);
                }
            }
        },

        isImageFile: function (file) {
            if (file.type) {
                return /^image\/\w+$/.test(file.type);
            } else {
                return /\.(jpg|jpeg|png|gif)$/.test(file);
            }
        },

        startCropper: function () {
            var _this = this;

            if (this.active) {
                this.$img.cropper('replace', this.url);
            } else {
                this.$img = $('<img src="' + this.url + '">');
                this.$avatarWrapper.empty().html(this.$img);
                this.$img.cropper({
                    aspectRatio: 1,
                    preview: this.$avatarPreview.selector,
                    strict: false,
                    crop: function (e) {
                        var json = [
                            '{"x":' + e.x,
                            '"y":' + e.y,
                            '"height":' + e.height,
                            '"width":' + e.width,
                            '"rotate":' + e.rotate + '}'
                        ].join();

                        _this.$avatarData.val(json);
                    }
                });

                this.active = true;
            }

            this.$avatarModal.one('hidden.bs.modal', function () {
                _this.$avatarPreview.empty();
                _this.stopCropper();
            });
        },

        stopCropper: function () {
            if (this.active) {
                this.$img.cropper('destroy');
                this.$img.remove();
                this.active = false;
            }
        },

        ajaxUpload: function () {
            var url = this.$avatarForm.attr('action');
            var data = new FormData(this.$avatarForm[0]);
            var _this = this;

            $.ajax(url, {
                type: 'post',
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,

                beforeSend: function () {
                    _this.submitStart();
                },

                success: function (data) {
                    _this.submitDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    _this.submitEnd();
                }
            });
        },

        syncUpload: function () {
            this.$avatarSave.click();
        },

        submitStart: function () {
            this.$loading.fadeIn();
        },

        submitDone: function (data) {
            console.log(data);

            if ($.isPlainObject(data) && data.state === 200) {
                if (data.result) {
                    this.url = data.result;

                    if (this.support.datauri || this.uploaded) {
                        this.uploaded = false;
                        this.cropDone();
                    } else {
                        this.uploaded = true;
                        this.$avatarSrc.val(this.url);
                        this.startCropper();
                    }

                    this.$avatarInput.val('');
                } else if (data.message) {
                    this.alert(data.message);
                }
            } else {
                this.alert('Failed to response');
            }
        },

        submitFail: function (msg) {
            this.alert(msg);
        },

        submitEnd: function () {
            this.$loading.fadeOut();
        },

        cropDone: function () {
            this.$avatarForm.get(0).reset();
            this.$avatar.attr('src', this.url);
            this.stopCropper();
            this.$avatarModal.modal('hide');
        },

        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            this.$avatarUpload.after($alert);
        }
    };

    $(function () {
        return new CropAvatar($('#crop-avatar'));
    });

});

$(function () {
    var country = $('select[name=country]');
    var location = $('select[name=location]');
    var first = $("select[name=location] :first").val();

    country.on('change', function () {
        $.get('/api/getCityList', {country: country.val()})
        .done(function (data) {
            if (data != 0) {
                location.empty();
                location.prepend('<option value="">' + first + '</option>');
                $.each(data, function (id, name) {
                    location.append('<option value="' + id + '">' + name + '</option>');
                });
            }
        });
    });

});

$(function () {
    $.getScript('/public/js/autosize.min.js', function () {
        autosize($('textarea'));
    });
});


function wsmessage(host, key) {

    var sendMessage = $('button[name=send-message]');
    sendMessage.click(function() {
        ws.send('{"key": "'+key+'","body": {"from": 1, "to": 2, "msg": "Текст сообщения"}}')
    });

    new ab.connect(host,
        function (session) {
            session.subscribe('one', function (topic, data) {
                console.info(topic);
                console.log(data.data);
            });
        },
        function(code, reason, detail) {
            console.warn(code + reason + detail);
        },
        {
            'maxRetries': 60,
            'retryDelay': 4000,
            'skipSubprotocolCheck': true
        }
    );
}

