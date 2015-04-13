//全选复选框
$('table th input:checkbox').on('click', function() {
    var that = this;
    $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function() {
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
});
$('table tr > td:first-child input:checkbox').on('click', function() {
    if (!this.checked) {
        $('table th input:checkbox').prop('checked', false);
    }
    var allChk = true;
    $('table tr > td:first-child input:checkbox').each(function(i, d) {
        if ($(this).prop('checked') == false) {
            allChk = false;
            return false;
        }
    });
    if (allChk)
        $('table th input:checkbox').prop('checked', true);
});

function openwinx(url, name, w, h) {
    if (!w)
        w = screen.width - 4;
    if (!h)
        h = screen.height - 95;
    window.open(url, name, "top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}

var public={};
public.dialog = function(options) {
    if (arguments.length > 1) {
        options = {
            title: arguments[0],
            url: arguments[1],
            data: arguments[2] || {},
            width: arguments[3] || 600
        };
    }
    var defaults = {
        title: '',
        id: '',
        url: '',
        width: 600,
        type: 'get',
        dataType: 'html',
        timeout: 10000, 
        data: {}
    };
    var settings = $.extend({}, defaults, options);
    $.ajax({
        url: settings.url,
        type: settings.type,
        timeout: options.timeout, 
        data: settings.data,
        dataType: options.dataType,
        beforeSend: function() {
     
        },
        success: function(result) {
            bootbox.dialog({
                title: settings.title,
                width: settings.width,
                id: settings.id,
                message: result
            });
        },
        error: function() {
            bootbox.alert('系统繁忙，请稍候再试!');
        },
        complete: function() {
           
        }
    });

};


public.Ajax = function(options) {
    var dftCfg = {
        type: 'post',
        dataType: 'json',
        timeout: 10000, //10秒超时
        callback: function() {
        }
    };
    var options = $.extend(dftCfg, options);
    $.ajax({
        url: options.url,
        data: options.data,
        dataType: options.dataType,
        type: options.type,
        timeout: options.timeout, //10秒超时
        beforeSend: function() {
           
        },
        success: function(result) {
            options.callback(result);
        },
        error: function() {
            bootbox.alert('系统繁忙，请稍候再试!');
        },
        complete: function() {
            $("body").find(".to8to-box-overlay-2").remove();
        }
    });
};

public.AjaxGet = function(options) {
    to8to.Ajax({
        type: 'get',
        url: options.url,
        data: options.data,
        dataType: options.dataType,
        timeout: options.timeout, //10秒超时
        callback: options.callback
    });
};
public.AjaxSaveForm = function(options) {
    var dftCfg = {
        type: 'post',
        dataType: 'json',
        timeout: 10000, //10秒超时
        callback: function() {
        }
    };
    var options = $.extend(dftCfg, options);
    var _this = options.obj;
    $.ajax({
        url: options.url,
        type: options.type,
        data: options.data,
        dataType: options.dataType,
        timeout: options.timeout, //10秒超时
        beforeSend: function() {
            _this.html('<i class="icon-save"></i>正在保存...').prop("disabled", true);
        },
        success: function(result) {
            options.callback(result);
        },
        error: function() {
            bootbox.alert('系统繁忙，请稍候再试!');
        },
        complete: function() {
            _this.html('<i class="icon-save"></i>保存').prop("disabled", false);
        }
    });
};



public.validate = function(options) {
    var defaults = {
        form: $("form"),
        type: 1, // 1. 表单竖排， 2. 表单横排
        rules: {},
        messages: {},
        submitHandler: function(form) {

        }
    };
    var settings = $.extend({}, defaults, options);
    $(settings.form).validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: true,
        rules: settings.rules,
        messages: settings.messages,
        invalidHandler: function(event, validator) { //display error alert on form submit   
            $('.alert-danger').show();
        },
        highlight: function(e) {
            if (settings.type == 1) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            } else {
                $(e).parent().removeClass('has-info').addClass('has-error');
            }
        },
        success: function(e) {
            if (settings.type == 1) {
                $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            } else {
                $(e).parent().removeClass('has-info').addClass('has-error');
            }
            $(e).remove();
        },
        errorPlacement: function(error, element) {
            if (element.is(':checkbox') || element.is(':radio')) {
//                    var controls = element.closest('div[class*="col-"]');
                var controls = element.parent().parent();
                if (controls.find(':checkbox,:radio').length > 1) {
                    controls.append(error);
                } else {
                    if (settings.type == 1)
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    else {
                        error.appendTo(element.parent());
                    }

                }
            }
            else {
                if (settings.type == 1)
                    error.insertAfter(element.parent());
                else
                    error.appendTo(element.parent());
            }
        },
        submitHandler: function(form) {
            settings.submitHandler(form);
        }

    });
};
