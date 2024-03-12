          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
		  </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © finessewebtech.com 2024</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Powered by <a href="#" target="_blank">Finesseweb tech</a></span>
            </div>
          </footer>
          <!-- partial -->
        
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url()?>public/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url()?>public/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url()?>public/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url()?>public/assets/js/off-canvas.js"></script>
    <script src="<?= base_url()?>public/assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url()?>public/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= base_url()?>public/assets/js/dashboard.js"></script>
    <script src="<?= base_url()?>public/assets/js/todolist.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	 <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
	
	<script>
	//new DataTable('#example');
	
	$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'pageLength', 'excel', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );


$(document).ready(function(){
    $("#addCF").click(function(){
		
$("#customFields").append('<div class="row" id="customFields1"><div class="col-md-6"><div class="form-group row"><label class="col-sm-3 col-form-label"> Name</label><div class="col-sm-9"><input type="text" class="form-control" name="fee_head_name[]" /></div></div></div><div class="col-md-6"><div class="form-group row"><a href="javascript:void(0);" class="remCF">Remove</a></div></div> </div>');
    });
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().parent().remove();
    });
});

$(document).ready(function(){

$("#academic_year_id").change(function(){
	var acad = $(this).val();
	 $.ajax({
      type: "POST",
      url: "<?= base_url()?>academicyear/getcast",
      data: { acad: acad},
      success: function (result) {
          if(result==='no'){
			$('#caste_category_id').prop('disabled', 'disabled');
      }
	  else {
		 $('#caste_category_id').prop('disabled', false);
	  }
	  }
 });

});


});

$(function() {
    $('.feesamt').on("blur", function(){
        
        var cost = 0;
        $(".feesamt").each(function() {
            var value = $(this).val();
            if (!isNaN(value) && value != "")
                cost+= parseFloat(value);
        })
        $('.cost').val(cost);
    });
});	

$('.showdetails').hide();
$('#showbtndetails').hide();	

$('#showhidedetails').on("click", function(){
$('.showdetails').show();
$('#showbtndetails').show();
$('#showhidedetails').hide();	
});

$('#showbtndetails').on("click", function(){
$('.showdetails').hide();
$('#showhidedetails').show();
$('#showbtndetails').hide();
	
});


   function select_term_fees(val, num, i, category_id, termno) {
	  // alert('hii');
        var len = $('input[name^="term_id"]').length;

        var total_term_amt = 0;
        var total_term1_amt1 = 0;
        var amt = 0;
        var cat_row_amt = 0;
        var inc = 0;
        var grand = 0;
        $('[id^="term' + num +'"]').each(function (e) {
			//alert('hii');
			var val = $(this).val();
            if (val) {
                amt += parseFloat(val);

            }
          });
        var amount = amt;

        $('input.term' + termno + category_id).each(function () {
            var value = parseFloat($(this).val());
            //alert(value);
            if (!isNaN(value)) {
                total_term_amt += value;
                //alert(total_term_amt);
            }
        });


        $('#feeheads_total' + num).html(amount);
        $('#feeheads_total_val' + num + '').val(amount);
        $('#term' + termno + '_total_' + category_id + '_' + i + '').html(total_term_amt);
        $('#catresult' + termno + category_id + '').val(total_term_amt);

        for (inc = 1; inc <= len; inc++) {
            cat_row_amt += !$('#catresult' + inc + '' + category_id).val() ? 0 : parseFloat($('#catresult' + inc + '' + category_id).val());
        }

	//cat_row_amt += total_term_amt;

        var cat = $('#cat_row_total' + category_id + '_' + i + '').val();

        $('#cat_total' + category_id + '_' + i + '').html(cat_row_amt);
       $('#cat_row_total' + category_id + '_' + i + '').val(cat_row_amt);



        $('span.term' + termno).each(function () {
           var value1 = parseFloat($(this).text());
            //alert(value1);
            if (!isNaN(value1)) {
                total_term1_amt1 += value1;
              //  alert(total_term1_amt1);
            }
       });

        for (inc = 1; inc <= len; inc++) {
            if (inc != termno) {
                grand += !$('#grand_result' + inc).val() ? 0 : parseFloat($('#grand_result' + inc).val());
            }
        }
        grand += total_term1_amt1;
        $('#term' + termno + '_grandtotal_').html(total_term1_amt1);
        $('#grand_result' + termno).val(total_term1_amt1);
        $('#grand_total').html(grand);
        $('#grandtotal_total').val(grand);
    }

	</script>
    <!-- End custom js for this page -->
  </body>
</html>