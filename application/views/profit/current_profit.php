
  <style>
	td.details-control {
    background: url('./web_root/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('./web_root/images/details_close.png') no-repeat center center;
    }
    
    .table-striped > tbody > tr:nth-of-type(odd)
    {
       background-color: #210707;
    }
 </style>
 
	  <div class="content-wrapper">
		<div class="container-fluid">
		  <div class="row">
			<div class="col-lg-12">
		  <div class="card mb-3">
			<div class="card-header"><i class="fa fa-pencil-square-o"></i> Current Profit</div>
			<div class="card-body">  
		
				<table id="example" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>S.No.</th>
							<th>Left PV</th>
							<th>Right PV</th>
							<th>Carry Left PV</th>
							<th>Carry Right PV</th>
							<th>New Pairs</th>
							<th>Binary</th>
							<!--<th>Leadership</th>
							<th>Leadership Boost.</th>
							<th>Upline</th>-->
						</tr>
					</thead> 
				</table>      
          </div>
        </div>
      </div>
      </div>
      </div>
      </div>
	
 

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
        "ajax": "<?php echo root(); ?>result-current-profit",
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
            // { "data": "leadership" },
            // { "data": "leadbooster_amount" },
            // { "data": "upline_bonus" },
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



