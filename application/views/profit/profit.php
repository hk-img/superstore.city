 

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet" />  

<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />  

 



 

  <style>

	td.details-control {

    background: url('./web_root/images/details_open.png') no-repeat center center;

    cursor: pointer;

}

tr.shown td.details-control {

    background: url('./web_root/images/details_close.png') no-repeat center center;

}

 </style>

 

    <section class="bg-white" id="about-us" style="margin:auto;">

      <div class="container">

			<div class="col-md-12 col-sm-12 col-xs-12 paddingZ table-responsive">

		

				<table id="example" class="table table-striped table-bordered">

					<thead>

						<tr>

							<th></th>

							<th>S.No.</th>

							<th>Left BV</th>

							<th>Right BV</th>

							<th>Carry Left BV</th>

							<th>Carry Right BV</th>

							<th>New BV</th>

							<th>Binary</th>

						</tr>

					</thead> 

				</table>      

          </div>

        </div>

      </div>

    </section>



<script src="https://code.jquery.com/jquery-1.12.4.js" ></script> 

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>

<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" ></script>		  

<script>

	/* Formatting function for row details - modify as you need */

function format ( d ) {

    // `d` is the original data object for the row

    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+



        '<tr>'+

            '<td>Gross Amount:</td>'+

            '<td>'+d.grossAmount+'</td>'+

        '</tr>'+

        '<tr>'+

            '<td>TDS:</td>'+

            '<td>'+d.tds+'</td>'+

        '</tr>'+

        '<tr>'+

            '<td>Admin:</td>'+

            '<td>'+d.admin_tds+'</td>'+

        '</tr>'+

        '<tr>'+

            '<td>Net Amount:</td>'+

            '<td>'+d.newAmount+'</td>'+

        '</tr>'+

            '<td>On Date:</td>'+

            '<td>'+d.onDate+'</td>'+

        '</tr>'+

    '</table>';

}

 

$(document).ready(function() {

	 

    var table = $('#example').DataTable( {

        "ajax": "<?php echo root(); ?>result-previous-profit",

        "columns": [

            {

                "className":      'details-control',

                "orderable":      false,

                "data":           null,

                "defaultContent": ''

            },

            { "data": "id" },

            { "data": "leftpv" },

            { "data": "rightpv" },

            { "data": "carryleftpv" },

            { "data": "carryrightpv" },

            { "data": "netpairs" },

            { "data": "binary" },

        ],

        "order": [[1, 'asc']]

    } );

     

    // Add event listener for opening and closing details

    $('#example tbody').on('click', 'td.details-control', function () {

        var tr = $(this).closest('tr');

        var row = table.row( tr );

 

        if ( row.child.isShown() ) {

            // This row is already open - close it

            row.child.hide();

            tr.removeClass('shown');

        }

        else {

            // Open this row

            row.child( format(row.data()) ).show();

            tr.addClass('shown');

        }

    } );

} );

</script>







