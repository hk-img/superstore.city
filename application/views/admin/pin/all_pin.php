 <section id="content" class="content-container">
<section class="page-form-ele page">

	 <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/create-pin'); ?>"><i class="fa fa-plus-circle"></i>  Create Pin</a>
            <a class="file-input-wrapper btn btn-default  btn-success" href="#" id="assign_pin" ><i  class="fa fa-exchange"></i>  Assign Pin to user</a>

        </div>

    </section>
	<section class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Search</strong></div>
        <div class="panel-body">
			<div class="space"></div>
			<label for="from">From</label>
			<input type="text" id="from" name="from" placeholder="From Date" required >
			<label for="to">To</label>
			<input type="text" id="to" name="to" placeholder="To Date" required>
			<p><b>Total Create PIN</b></p>
			<p><b>Total PIN Amount</b></p>
        </div>
    </section>
	
	 <div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>
 

			  <div class="panel-body">
			  <span id="responsesMsg"></span>
                    <div class="table-responsive">
                <table id="allPin" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
							<th><input type="checkbox" class="form-control" style="height: 18px;text-align: left;background: #139ED9 !important;color: #139ED9 !important;" id="select_all" ></th>
                            <th> S.No</th>
                            <th> Created Date</th>
                            <th> Pin No</th>
                            <th> Assign UniqueId</th>
                            <th> Used Status</th>
                            <th> Member Name</th> 
                            <th> Amount</th>
                            <th> Business Volume</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php 
							$pinResult=$this->db->order_by('pin_id','desc')->get('str_pinlist')->result();
							if(!empty($pinResult))
							{
								$s_no=1;
								foreach($pinResult as $pinResultKey=>$pinResultValue)
								{
						  ?>
                        <tr>
							<td><input type="checkbox" <?php if($pinResultValue->assign_userid!='' || $pinResultValue->assign_userid>'0'){ echo "disabled"; } ?>  class="form-control <?php if($pinResultValue->assign_userid=='' ||  $pinResultValue->assign_userid=='0'){ echo "checkbox"; } ?>" style="height: 18px;text-align: left;background: #139ED9 !important;color: #139ED9 !important;"  value="<?php echo $pinResultValue->pin_id; ?>"/></td>
                            <td><?php echo $s_no;?></td>
                            <td><?php echo $pinResultValue->created_date; ?></td>
                            <td><?php echo ucfirst($pinResultValue->pin_no);?></td>
                            <td><?php echo getUniqueIdById($pinResultValue->assign_userid);?></td>
                            <td><?php echo pinusedStatus($pinResultValue->used_status);?></td>
                            <td><?php echo getNameByMemberId($pinResultValue->used_byid);?></td> 
                            <td><?php echo $pinResultValue->amount; ?></td>
                            <td><?php echo $pinResultValue->business_volume; ?></td>
                             
                            
                        </tr>
					<?php $s_no++; } ?>
					<?php  } ?>
                    </tbody>
                </table>
   </div>
                </div>
            </section>

            <!-- end Radio buttons and checkbox -->            
        </div>
	 </div>
</section>
</section>

<!--Assign pin to user modal window-->
<div id="pinAsigntouserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form action="#" name="assignPinuser" id="assignPinuser">
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pin Assign to user </h4>
      </div>
      <div class="modal-body">
        <label>Enter user Unique Id </label><span class="required" style="color:red">*</span>
		<input type="text" class="form-control" placeholder="Enter user Unique Id" required name="assignUser_name"/>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default"  >Submit</button>
        <button type="reset" class="btn btn-default"  >Reset</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>

  <script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+0w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+0w",
        changeMonth: true,
		changeYear: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
  
<script>
$(document).ready(function(){ 
   $('#select_all').on('click',function(){
       if(this.checked){
           $('.checkbox').each(function(){
               this.checked = true;
           });
       }else{
            $('.checkbox').each(function(){
               this.checked = false;
           });
       }
   });
   
   $('.checkbox').on('click',function(){
       if($('.checkbox:checked').length == $('.checkbox').length){
           $('#select_all').prop('checked',true);
       }else{
           $('#select_all').prop('checked',false);
       }
   });
});

$(document).ready(function(){ 
    $('#assign_pin').on('click',function(){ 
	var vals = new Array();
	var chkArray12 = [];
	$(".checkbox:checked").each(function() {
		chkArray12.push($(this).val());
	});
	 
	if(chkArray12 !=""){
		 $('#pinAsigntouserModal').modal('show'); 
	}
	else{
		alert("Please check atlest one Pin for assign to user");
	}
	});
});


</script>

 <script>
// 
$(function() {
  $("form[name='assignPinuser']").validate({
    // Specify validation rules
    rules: {
      assignUser_name: {
		  required:true,
		  remote: {
			url:  "<?php echo base_url('admin/check-unique-id'); ?>",
			type: 'post', 
		  }
	  },  
     },
    // Specify validation error messages
    messages: 
	{
		assignUser_name: {
			required:"Please Enter User Unique Id.",
			remote:"Please Enter Correct Unique Id.",
		}, 
     }, 
    submitHandler: function(form) { 
	
		var vals = new Array();
		var chkArray12 = [];
		$(".checkbox:checked").each(function() {
			chkArray12.push($(this).val());
		});
		$("#payroll_loader").css("display", "block");
		$('#responsesMsg').html(''); 
		$.ajax({
			url: "<?php echo base_url('admin/Pin/pinAssignEnd'); ?>?userId="+chkArray12,
			type: 'post',
			dataType: 'json',
			data:  $('form#assignPinuser').serialize(),
			error: function(){
				$('#pinAsigntouserModal').modal('hide');
				$("#payroll_loader").show().fadeOut(500); 
				$('#responsesMsg').html('<div class="callout callout-danger"><p class="ng-binding"><i class="fa fa-times-circle-o"></i> Something wrong.Please Try Again.</p></div>').show().fadeOut(5000); 
			 },
			success: function(data)
			{ 
			
				if(data.status==1){
				   location.reload();
					$('form#assignPinuser')[0].reset();
					$('#responsesMsg').html('<div class="callout callout-info"><p class="ng-binding"><i class="fa fa-check-circle"></i> '+data.msg+'</p></div>').show().fadeOut(500000000); 
					
				}else{
					$('#responsesMsg').html('<div class="callout callout-warning"><p class="ng-binding"><i class="fa fa-times-circle-o"></i> '+data.msg+' </p></div>').show().fadeOut(5000); 
					
				}
				 $('#pinAsigntouserModal').modal('hide');
				 $("#payroll_loader").css("display", "none");
			  }
		});
	
	 return false;
    }
  });
});

</script>

<script> 

	$(document).ready(function() {
		$('#allPin').DataTable(
		{
			 "pageLength": 50,
		}
		);
	} );
</script>
