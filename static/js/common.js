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

