var TableAdvanced = function () {

    var initTable1 = function(detailcb) {
        var detialCallback = detailcb;
        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );

             /*
            var sOut = '<table>';
            sOut += '<tr><td>' + ChineseLan.mat+':</td><td>'+aData[8]+'</td></tr>';
            sOut += '<tr><td>' + ChineseLan.home+':</td><td>'+aData[9]+'</td></tr>';
            sOut += '<tr><td>' + ChineseLan.status+':</td><td>'+aData[10]+'</td></tr>';
            sOut += '<tr><td>' + ChineseLan.cv+':</td><td>'+aData[11]+'</td></tr>';
            sOut += '<tr><td>' + ChineseLan.note+':</td><td>'+aData[12]+'</td></tr>';
            sOut += '<tr><td>' + ChineseLan.tag+':</td><td>'+aData[13]+'</td></tr>';
            sOut += '</table>';
             
            return sOut;
            */

            if(!!detialCallback){
                detialCallback(aData[1], function(result){
                     oTable.fnOpen( nTr, result, 'details' );
                });
            }
            else{
              $.ajax({
                    type: "GET",
                    url: "/candidate/detail/" + aData[1],
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (result) {
                        oTable.fnOpen( nTr, result, 'details' );
                    }
                });  
            }
            
        }

        function fnGetData(oTable, sKeywords)
        {
            if(!sKeywords) sKeywords = "";

            oTable.fnReloadAjax('/candidate/search/' + sKeywords);
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
         
        $('#sample_1 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#sample_1 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#sample_1').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
            "bPaginate":true,
            "bInfo":false,
            "bServerSide":false,
            "bProcessing": false,
            "bFilter":false
        });

        //Remove default datatable logic tied to these events
        /*
        var searchbox = jQuery('#sample_1_wrapper .dataTables_filter input');
        searchbox.unbind();
        searchbox.bind('keyup change', function (e) {
           if(e.keyCode == 13) {
                fnGetData(oTable, this.value);
           }
           return;
        });
        */

        jQuery('#sample_1_wrapper .dataTables_filter input').addClass("m-wrap big"); // modify table search input
        jQuery('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#sample_1').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */                
                $(this).addClass("row-details-open").removeClass("row-details-close");
                //oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
                fnFormatDetails(oTable, nTr)
            }
        });
    }

     var initTable2 = function() {
        var oTable = $('#sample_2').dataTable( {           
            "aoColumnDefs": [
                { "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        jQuery('#sample_2_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('#sample_2_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#sample_2_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown

        $('#sample_2_column_toggler input[type="checkbox"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    }

    var initTable3 = function() {

        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = aData[6];
             
            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
         
        $('#sample_3 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#sample_3 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#sample_3').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
            "bPaginate":false,
            "bInfo":false,
            //"bServerSide":true,
            "bProcessing": true,
            //"sAjaxSource": "{{ URL::to('admin/blogs/data') }}"
        });

        jQuery('#sample_3_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('#sample_3_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#sample_3_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#sample_3').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */                
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
            initTable2();
            initTable3();
        },
        initDetailTable : function(tableName,cb){
            if (!jQuery().dataTable) {
                return;
            }

            initTable1(cb);
        }



    };

}();