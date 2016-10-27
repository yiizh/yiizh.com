/**
 * Ajax Modal
 */
+function ($) {
    'use strict';
    $.yiizh = $.yiizh == undefined ? {} : $.yiizh;
    var AjaxModal = $.yiizh.AjaxModal = function (element) {
        this.element = $(element);
        if (this.element.attr('data-target') == undefined) {
            this.modal = $('#modal-default');
        } else {
            this.modal = $(this.element.attr('data-target'));
        }

    };

    AjaxModal.timeout = 5000;

    AjaxModal.prototype.show = function () {
        var $this = this.element;
        this.modal.modal('show');
        this.load(this.element.attr('href'));
    };


    AjaxModal.prototype.load = function (url) {
        var $this = this.element;
        var that = this;
        that.clearModalBody();
        that.setModalBody('<div class="text-center" style="margin:60px 0;"><p><i class="fa fa-spinner fa-spin fa-5x fa-fw"></i></p><p>正在加载中...</p></div>');

        var request = $.ajax({
            url: url,
            timeout: this.timeout,
            type: 'get',
            complete: function (XMLHttpRequest, status) { //请求完成后最终执行参数
                that.clearModalBody();
                var html = '';
                if (status == 'timeout') {//超时,status还有success,error等值的情况
                    request.abort();
                    alert("超时");
                }

                if (status == 'error') {
                    html = '<div class="alert alert-error"><h4>' + XMLHttpRequest.statusText + '</h4><p>' + XMLHttpRequest.responseText + '</p></div>';
                }

                if (status == 'success') {
                    html = XMLHttpRequest.responseText;
                }
                that.setModalBody(html);
            }
        });
    };

    AjaxModal.prototype.clearModalBody = function () {
        this.modal.find('.modal-body').html('');
    };

    AjaxModal.prototype.setModalBody = function (html) {
        this.modal.find('.modal-body').html(html);
    };


    var clickHandler = function (e) {
        e.preventDefault();
        (new AjaxModal(this)).show();
    };

    $(document)
        .on('click', '[data-toggle="ajax-modal"]', clickHandler);

}(jQuery);