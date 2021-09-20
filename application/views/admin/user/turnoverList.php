 
<section id="content" class="content-container">
<section class="page-form-ele page">

	<section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Search By Month and Year</strong></div>

        <div class="panel-body">

			<div class="space"></div>
			<form action="<?php echo base_url('admin/User/showturnover'); ?>" method="post">
				<div class="col-md-3">
				<select name="month" class="form-control">
					<option <?php if($month=='01'){ echo "selected"; } ?> value="01">January</option>
					<option <?php if($month=='02'){ echo "selected"; } ?> value="02">Febuary</option>
					<option <?php if($month=='03'){ echo "selected"; } ?> value="03">March</option>
					<option <?php if($month=='04'){ echo "selected"; } ?> value="04">April</option>
					<option <?php if($month=='05'){ echo "selected"; } ?> value="05">May</option>
					<option <?php if($month=='06'){ echo "selected"; } ?> value="6">June</option>
					<option <?php if($month=='07'){ echo "selected"; } ?> value="07">July</option>
					<option <?php if($month=='08'){ echo "selected"; } ?> value="08">Auguest</option>
					<option <?php if($month=='09'){ echo "selected"; } ?> value="09">September</option>
					<option <?php if($month=='10'){ echo "selected"; } ?> value="10">October</option>
					<option <?php if($month=='11'){ echo "selected"; } ?>  value="11">November</option>
					<option <?php if($month=='12'){ echo "selected"; } ?>  value="12">December</option>
				</select>
				</div>
				<div class="col-md-3">
					<select name="year" class="form-control">
						<option  <?php if($year=='2017'){ echo "selected"; } ?> value="2017">2017</option>
						<option  <?php if($year=='2018'){ echo "selected"; } ?> value="2018">2018</option>
						<option  <?php if($year=='2019'){ echo "selected"; } ?> value="2019">2019</option>
						<option  <?php if($year=='2020'){ echo "selected"; } ?> value="2020">2020</option>
						<option  <?php if($year=='2021'){ echo "selected"; } ?> value="2021">2021</option>
						<option <?php if($year=='2022'){ echo "selected"; } ?> value="2022">2022</option>
						<option <?php if($year=='2023'){ echo "selected"; } ?> value="2023">2023</option>
						<option <?php if($year=='2024'){ echo "selected"; } ?> value="2024">2024</option>
						<option <?php if($year=='2025'){ echo "selected"; } ?> value="2025">2025</option>
						<option <?php if($year=='2026'){ echo "selected"; } ?> value="2026">2026</option>
						<option <?php if($year=='2027'){ echo "selected"; } ?> value="2027">2027</option>
						<option <?php if($year=='2028'){ echo "selected"; } ?> value="2028">2028</option>
					</select>	
			   </div>
					<input type="submit" value="submit" name="submit" class="file-input-wrapper btn btn-default  btn-success" value="Submit" />
					<input type="submit" class="file-input-wrapper btn btn-default  btn-danger" value="Reset" />
			   </div>
			</form>
    </section>
	 <div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong><span style="float:right">Total Business Amount:-<strong><?php echo number_format($total_business,2); ?></strong></span></div>
			<div class="panel-body">
                    <div class="table-responsive">
                <table id="allUser" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No</th>
                            <th> Date</th>
                            <th> Turnover Amount</th>  
                        </tr>
                    </thead>
                    <tbody>
					 <?php   
							$s_no=1;
							$finalamount=0;
							foreach($list as $listKey)
							{
					  ?>
								 
                        <tr>
                            <td><?php echo $s_no;?></td>
                            <td><?php 
								echo date("d-M-Y D", strtotime($listKey));	
							?></td>
                            <td>
							<?php 
							$date='';
							$date=date("Y-m-d", strtotime($listKey));
							echo $amount=$this->Form_model->getTotalTurnover($date,$date); 
							$finalamount=$finalamount+$amount;
							?></td>   
                        </tr>
					<?php $s_no++; } ?> 
                    </tbody>
					<tfoot>
						<tr>
						  <th colspan="2" >Total Monthly Turnover</th>
						  <th>$ <?php echo $finalamount; ?></th>
						</tr>
					</tfoot>
                </table>
   </div>
                </div>
            </section>

            <!-- end Radio buttons and checkbox -->            
        </div>
    </div>
</section>
</section>
<script> 

	$(document).ready(function() {
		$('#allUser').DataTable(
		{
			 "pageLength": 50,
		}
		);
	} );
</script>
