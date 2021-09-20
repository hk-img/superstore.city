<script> 
      setTimeout(function(){ $('.alert-warning').css('display','none') }, 3000);
      setTimeout(function(){ $('.alert-success').css('display','none') }, 3000); 
</script>
  <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright ©AYR Group 2018</small>
        </div>
      </div>
    </footer>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="color: #333;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-success" href="<?php echo base_url('logout'); ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
	<script>
			window.oncontextmenu = function () {
			return false;
			}
			$(document).keydown(function (event) {
			if (event.keyCode == 123) {
			return false;
			}
			else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.ctrlKey  && event.keyCode == 85) || (event.ctrlKey && event.shiftKey && event.keyCode == 67))  {
			return false;
			}
			});
	</script>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/sb-admin.min.js"></script>
 </body>

</html>