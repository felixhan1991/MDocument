var EditableTable = function () {
var url =window.location.protocol.concat("//");
    url = url.concat(window.location.hostname);
    var url2= window.location.pathname;
    var port= window.location.port;
    url = url.concat(":");
    url = url.concat(port);
    url = url.concat("/");
    var res = url2.split("/");
    url = url.concat(res[1]);
    
    return {

        //main function to initiate the module
        init: function () {
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
                jqTds[0].innerHTML = '<input readonly type="text" class="form-control small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<a class="edit" href="">Save</a>';
                jqTds[3].innerHTML = '<a class="cancel" href="">Cancel</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 2, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 3, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 2, false);
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
                "aLengthMenu": [
                    [10, 20, -1],
                    [10, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 10,
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
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

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#editable-sample_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['', '', '', '',
                        '<a class="edit" href="">Edit</a>', '<a class="cancel" data-mode="new" href="">Cancel</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
            });

            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }
                url = url.concat("/role/removeRole");
                oTable.fnDeleteRow(nRow);
                $.ajax({
                        type: "post",
                        url: url,
                        cache: false,				
                        data: {
                          id:nRow.cells[0].innerHTML
                        },
                        success: function(json){						
                        try{		
                                var obj = jQuery.parseJSON(json);
                                alert("Data telah dihapus!");
                                window.location=url2;

                        }catch(e) {		
                            e.toString();
                                alert('Exception while request..');
                        }		
                        },
                        error: function(){						
                                alert('Error while request..');
                        }
                    });
            });

            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];
                var jqInputs = $('input', nRow);
                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    url = url.concat("/role/editRole");
                    $.ajax({
                        type: "post",
                        url: url,
                        cache: false,				
                        data: {
                          id:nRow.cells[0].innerHTML,
                          val:nRow.cells[1].innerHTML
                        },
                        success: function(json){						
                        try{		
                                var obj = jQuery.parseJSON(json);
                                alert("Data telah di-update!");
                                window.location=url2;

                        }catch(e) {		
                            e.toString();
                                alert('Exception while request..');
                        }		
                        },
                        error: function(){						
                                alert('Error while request..');
                        }
                    });
                    
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();