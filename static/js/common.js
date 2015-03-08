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

