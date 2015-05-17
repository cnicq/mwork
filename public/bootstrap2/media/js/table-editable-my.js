var MyTableEditable = function () {

    return {

        //main function to initiate the module
        init: function (tableName) {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="m-wrap small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="m-wrap small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<a class="edit" href="">保存</a>';
                jqTds[3].innerHTML = '<a class="cancel" href="">取消</a>';
            }

            function editNewRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="m-wrap small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="m-wrap small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<a class="edit" href="">保存</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 2, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 3, false);
                oTable.fnDraw();
                var ds = "name=" + jqInputs[0].value + "&text=" + jqInputs[1].value + "&type=" + $('#sel_datatype').val();
               
                // sync server
                $.ajax({
                type:"POST",
                url:"/manage/datavalue/update",
                datatype: 'json',
                data:ds,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
                success: function(d){
                   
                }
                });
            }

            function deleteRow(oTable, nRow){
                var n = nRow.cells[1].innerHTML;
                oTable.fnDeleteRow(nRow);
                
                // sync server
                $.ajax({
                type:"POST",
                datatype: 'json',
                url:"/manage/datavalue/delete",
                data:"name=" + n,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
                success: function(d){
                   
                }
                });
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 2, false);
                oTable.fnDraw();
            }

            var oTable = $('#' + tableName).dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#'+tableName+'_wrapper .dataTables_filter input').addClass("m-wrap medium"); // modify table search input
            jQuery('#'+tableName+'_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
            jQuery('#'+tableName+'_wrapper .dataTables_length select').select2({
                showSearchInput : false //hide search box with special css class
            }); // initialzie select2 dropdown

            var nEditing = null;

            $('#'+tableName+'_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['','',
                        '<a class="edit" href="">编辑</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editNewRow(oTable, nRow);
                nEditing = nRow;
            });

            $('#'+tableName+' a.delete').live('click', function (e) {
                e.preventDefault();

                if (confirm("确定要删除该行数据吗?") == false) {
                    return;
                }
                 var nRow = $(this).parents('tr')[0];
                deleteRow(oTable, nRow);
            });

            $('#'+tableName+' a.cancel').live('click', function (e) {
                e.preventDefault();
                var mode = $(this).attr("data-mode");
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#'+tableName+' a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "保存") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();