var TableAdvanced = function () {

    var initTable1 = function(tableName, detailcb) {
        var detialCallback = detailcb;
        var tName = tableName;
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
         
        $('#'+tName+' thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#'+tName+' tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#'+tName).dataTable( {
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
        var searchbox = jQuery('#'+tName+'_wrapper .dataTables_filter input');
        searchbox.unbind();
        searchbox.bind('keyup change', function (e) {
           if(e.keyCode == 13) {
                fnGetData(oTable, this.value);
           }
           return;
        });
        */

        jQuery('#'+tName+'_wrapper .dataTables_filter input').addClass("m-wrap big"); // modify table search input
        jQuery('#'+tName+'_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#'+tName+'_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#'+tName).on('click', ' tbody td .row-details', function () {
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

     var initTable2 = function(tableName) {
        var tName = tableName;
        var oTable = $('#'+tName).dataTable( {           
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

        jQuery('#'+tName+'_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('#'+tName+'_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#'+tName+'_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown

        $('#'+tName+'_column_toggler input[type="checkbox"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    }

    var initTable3 = function(tableName) {
        var tName = tableName;
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
         
        $('#'+tName+' thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#'+tName+' tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#'+tName).dataTable( {
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

        jQuery('#'+tName+'_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('#'+tName+'_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#'+tName+'_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#'+tName).on('click', ' tbody td .row-details', function () {
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

            initTable1('sample_1');
            initTable2('sample_2');
            initTable3('sample_3');
        },
        initDetailTable : function(tableName,cb){
            if (!jQuery().dataTable) {
                return;
            }

            initTable1(tableName, cb);
        }



    };

}();