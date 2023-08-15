function reset_keydown_shortcut(){
    shortcut.remove('ESC');
    shortcut.remove('ENTER');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F6');
    shortcut.remove('F7');
    shortcut.remove('F8');
    shortcut.remove('F9');
    shortcut.remove('F10');
    shortcut.remove('F12');
    shortcut.add('ESC',function () {});
    shortcut.add('ENTER',function () {});
    shortcut.add('F2',function () {});
    shortcut.add('F3',function () {});
    shortcut.add('F4',function () {});
    shortcut.add('F6',function () {});
    shortcut.add('F7',function () {});
    shortcut.add('F8',function () {});
    shortcut.add('F9',function () {});
    shortcut.add('F10',function () {});
    shortcut.add('F12',function () {});
}

function branch_open_modal_map() {
    $('#modal-branch-map').modal('show');
}
function branch_close_map() {
    $('#modal-branch-map').modal('hide');
}

function loadData() {
    let method = 'GET',
        url = 'branch.data',
        params = '',
        data = '';
    axiosTemplate(method, url, params, data).then(res => {
        loadTable(res.data.data);
    })
}

function loadTable(data) {
    let id =$('#branch-table'),
        column = [
            {data: 'id', name: 'id',className:'text-center'},
            {data: 'name', name: 'name',className:'text-center'},
            {data: 'phone', name: 'phone',className:'text-center'},
            {data: 'address', name: 'address',className:'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
        ],
        scroll_Y = '65vh',
        fixed_left = 2,
        fixed_right = 1;
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right);
}

$(function () {
    shortcut.remove('ESC');
    $("#design-wizard-custom").steps({
        headerTag: "h3",
        bodyTag: "div.next-step",
        transitionEffect: "slideLeft",
        autoFocus: true,
        onFinished: function (event, currentIndex)
        {
            saveUpdateBranch();
        }
    });
    loadData();

});
