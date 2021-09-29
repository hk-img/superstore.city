<?php 

	$root = base_url();

?>

<footer class="site-footer style-1" id="footer">
   <div class="footer-top">
     <div class="container">
       <div class="footer-info wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">
         <div class="row align-items-center">
           <div class="col-xl-6 col-md-4 mt">
 					<img src="<?php echo $root;?>web_root/images/logo-r.png" alt="Logo" class="img-size bg-img img-responsive" />
           <!-- <span class="hidden-md logo">TMSS</span>  -->
        </div>
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="icon-bx-wraper left m-b10">
               <div class="icon-lg"><a href="javascript:void(0);" class="icon-cell">
			   <i class="fa fa-mobile" aria-hidden="true"></i>
				</a>
               </div>
               <div class="icon-content icnew">
                 <p>+91 987-654-3210<br>info@example.com</p>
               </div>
             </div>
           </div>
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="icon-bx-wraper left m-b10">
               <div class="icon-lg"><a href="javascript:void(0);" class="icon-cell"><i class="fa fa-map-marker" aria-hidden="true"></i>

</a></div>
               <div class="icon-content icnew">
                 <p>Royal super store,Chandigarh</p>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-xl-6 col-lg-6 col-sm-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
           <div class="widget widget_about">
             <!-- <h5 class="footer-title">About Us</h5> -->
             <p>Maecenas pellentesque placerat quam, in finibus nisl tincidunt sed. Aliquam magna augue, malesuada ut</p>

           </div>
         </div>
         <div class="col-xl-6 col-lg-6 col-sm-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
           <div class="widget widget_services">
             <!-- <h5 class="footer-title">Our links</h5> -->
             <ul>
               <li><a href="<?= base_url(''); ?>">Home</a></li>
               <li><a href="<?= base_url('legal-document'); ?>">Legal Documents</a></li>
               <li><a href="<?= base_url('contact-us'); ?>">Contact Us</a></li>
               <li><a href="<?= base_url('login'); ?>">Login</a></li>
               <li><a href="<?= base_url('registration'); ?>">Register</a></li>
             </ul>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="footer-bottom wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
     <div class="container">
       <div class="row">
         <div class="col-sm-12 text-center"><span class="copyright-text">Copyright © 2021 Royal Super Store. All rights reserved.</span></div>
       </div>
     </div>
   </div>
 </footer>

<script src="<?php echo $root; ?>web_root/admin_root/js/vendor.js"></script>

<script src="<?php echo $root; ?>web_root/admin_root/js/ui.js"></script>

<script src="<?php echo $root; ?>web_root/admin_root/js/app.js"></script>

<script src="<?php echo $root; ?>web_root/jquery.js"></script>


<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 	 
 
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script> 	
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


 <script>

	function ValidateAlpha(evt) 
    { 
        var keyCode = (evt.which) ? evt.which : evt.keyCode 
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 10  && keyCode != 32) 
        return false; 
		return true; 

    }

	function isNumberKey(evt)
	{  <!--Function to accept only numeric values-->

    //var e = evt || window.event;

	var charCode = (evt.which) ? evt.which : evt.keyCode 
    if (charCode != 46 && charCode > 31  
	&& (charCode < 48 || charCode > 57)) 
        return false; 
        return true;
	}

 function deleteMsg(){

	   $('#message-box').css("display","none");

 }

  $('#message-box').delay(3000).fadeOut(400);

   $("#payroll_loader").css("display", "none");  

</script> 

<script>

	function confirm_box(){

		var result = confirm("Want to Continue?");

		if (result) {

			return true;

		}

		else{

			return false;

		}

	}	

</script>

 </body>

</html>