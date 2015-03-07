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


