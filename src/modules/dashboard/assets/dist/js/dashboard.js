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

+function ($) {
    'use strict';
    $.yiizh = $.yiizh == undefined ? {} : $.yiizh;
    var AjaxPost = $.yiizh.AjaxPost = function (element) {
        var $this = this.element = $(element);
        var data = this.element.attr('data-data')== undefined ? '成功' : JSON.parse(this.element.attr('data-data'));
        var url = this.element.attr('data-url');
        var success = this.element.attr('data-success') == undefined ? '成功' : this.element.attr('data-success');
        var postingText = this.element.attr('data-postingText') == undefined ? '正在提交...' : this.element.attr('data-postingText');

        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            data: data,
            beforeSend: function () {
                $this.html('<i class="fa fa-spinner fa-spin"></i> ' + postingText);
                $this.addClass('disabled');
            },
            complete: function () {
            },
            success: function (rs) {
                if (rs.success) {
                    $this.html(success);
                    $this.removeClass('btn-default');
                    $this.addClass('btn-success');
                } else {
                    $this.html(rs.errorMessage);
                }
            },
            error: function () {
                $this.html('提交失败');
            }
        });
    };

    var clickHandler = function (e) {
        e.preventDefault();
        new AjaxPost(this);
    };
    $(document).on('click', '[data-toggle="ajax-post"]', clickHandler);
}(jQuery);