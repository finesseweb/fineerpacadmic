
<?php
//error_reporting(0);
$date =  date('Y-m-d');
$col_span = 2 + count($term_data);
?>
<tr class="feeclose">
    <td colspan="6">
        <div class="purchase-quatation-items" style="display: block;"><div class="col-sm-12 " >
                <div id="log1">  
                    <div class="panel panel-default bor" >
                        <div class="panel-body" style="">
                            <div>
                                <div class="col-sm-0" style="float:right;">
                                   <!-- <a class="btn btn-primary" target="_blank" href="#<?php //echo $this->mainconfig['host'];  ?>fee-structure/structure-pdf/id/<?php //echo $this->structure_id;  ?>">Print</a>--><a class="btn btn-link" role="button" href="#" id="print"><span class='glyphicon glyphicon-print'></span></a></div>
                                <div class="col-sm-2" style="float:right;"><button class="close_tr btn btn-primary">Close</button></div>

                                <div class="col-sm-12" width="99%"><center>
                                        <div class="form-group bor" style="">

                                            <label class="control-label"><strong><h4>Fee Details</h4></strong></label>
                                        </div></center>
                                </div>

                            </div>
                        </div>
						
                        <div class="row" style="margin-bottom:5px;" >
                            <div class="col-sm-12">
                                <div class="form-group bor col-md-12" >
                                     <table width="99%" class="table table-striped table-bordered mb30 table bulk_action" border="0" >
                                        <thead>
                                            <tr align="center">
                                                <th rowspan="2" style="text-align:center;" bgcolor="#f7ffe6">S.No.</th>
                                                <th rowspan="2" style="text-align:center;" bgcolor="#f7ffe6">Particulars</th> 



                                                <?php foreach ($term_data as $key => $term_details) { ?>
                                                    <?php $inc = $key + 1; ?>
                                                    <th style="text-align:center;" bgcolor="#f7ffe6"><?php echo $term_details['semester_name']; ?></th>

                                                <?php } ?>
                                                <th rowspan="3" style="text-align:center;" bgcolor="#f7ffe6">Total (Rs.)</th>  
                                            </tr>
                                            <!--<tr>-->
                                               <?php
                                                // $items_result = $result1;
												// print_r($items_result );die();
                                                //if (!empty($items_result)) { ?>
                                                <?php //foreach ($term_data as $key => $term_details) { ?>
                                                <?php //$inc = $key + 1; ?>
                                                <!--<td align="center"  bgcolor="#f7ffe6"><?php //echo $items_result["t" . $inc]; ?></td>
                                                 <?php //} ?>
                                                 </tr>-->

                                                   


                                                    <?php
                                               // } else {
                                                    ?>
                                                    <!--<td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td ></td>
                                                    <td></td>-->
                                                <?php //} ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // print_r($this->academics_data);
                                            // $i=1;
                                            $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
                                            $i = 0;

                                            //echo '<pre>'; print_r($this->Feeheads_data['feehead_name']);						
                                            if (($feescategorys) > 0) {
                                                $fee_head = $heads;
                                                //echo '<pre>'; print_r($this->Category_data['feecategory_id']); 
                                                foreach ($feescategorys as $key => $categories) {
                                                    ?>

                                                    <tr>
                                                               <!-- <td align="center"><?php //echo $letters[$i]; ?></td> -->
                                                        <td align="left" colspan="<?= $col_span; ?>" bgcolor="#f7ffe6"><?php
                                                            // if($categories['category_id'] == $fee_head[$key]['feecategory_id']){
                                                            echo $letters[$i] . '. ' . $categories['fee_category_name'] . ' ' . '(Rs.)';
                                                            // } 
                                                            ?>
                                                            <input type="hidden" name="terms[category_id][]" id="category_id" value="<?php echo $categories['fee_category_id']; ?>" />
                                                        </td> 
                                                        <td bgcolor="#f7ffe6" ></td>

                                                    </tr>
                                                    <?php
                                                    $j = 1;
                                                    $term1_cat_tot = 0;
                                                    $term2_cat_tot = 0;
                                                    $term3_cat_tot = 0;
                                                    $term4_cat_tot = 0;
                                                    $term5_cat_tot = 0;
                                                    foreach ($heads as $keys => $vals) {
                                                        //print_r($
                                                        if ($categories['fee_category_id'] == $vals['fee_category_id']) {
                                                            ?>
                                                            <tr>
                                                                <td align="center"><?php echo $j; ?><input type="hidden" name="terms[count][]" value="<?php echo $j; ?>"/></td>
                                                                <td><?php echo $vals['fee_head_name']; ?><input type="hidden" name="terms[feehead_id<?php echo $categories['fee_category_id']; ?><?php echo $j; ?>][]" id="feehead_id<?php echo $j; ?>" value="<?php echo $vals['fee_head_id']; ?>" /></td>
                                                                <?php
                                                                if (!empty($result1)) {
                                                                    $TermItems_model = $feestructures;
                                                                    $cat_ids = $categories['fee_category_id'];
                                                                    $fhead_ids = $vals['fee_head_id'];
																	
																	//echo $structures_id'; die();
                                                                    ?>
                                                                    <?php foreach ($term_data as $key => $term_details) { ?>
                                                                        <?php $inc = $key + 1; ?>
                                                                        <td>
                                                                           <a href="#"  data-toggle="modal" data-target="#instalmentModal" > <?php $term1_result = $TermItems_model->getamountbyhead($structures_id, $cat_ids, $fhead_ids, $term_data[$key]['cmn_terms']); ?>
                                                                            <?php
																			//print_r($term1_result); die();
                                                                            $term1_cat_tot += $term1_result['amount'];
                                                                            echo $term1_result['amount'];
                                                                            ?></a></td>
                    <?php } ?>


                                                                    <td style="text-align:center;"><?php echo $term1_result['fee_head_total']; ?> 
                                                                    </td>	
                                                                     
                                                                    <?php
                                                                   // }
                                                                } else {
                                                                    ?>	
                                                                     <?php foreach($term_data as $key => $term_details) {?>
                                                <?php $inc = $key+1; ?> 
						<td>
						<input type="text" name="term_<?php echo $categories['fee_category_id'];?>_<?php echo $vals['fee_head_id'];?>_<?=$inc;?>" id ="term<?php echo $j;?><?=$inc;?>" class="form-control term<?=$inc;?><?php echo $categories['fee_category_id']; ?> term" onchange="select_term<?=$inc;?>_fees(this.val,<?php echo $j;?>,<?php echo $i;?>,<?php echo $categories['fee_category_id'];?>)" style="text-align:right;" value="<?php //echo $this->termitems_result[$keys]['fees'];?>"/></td>
                                                <?php } ?>
						<td><span id="feeheads_total<?php echo $j;?>"></span>
						<input type="hidden" name="terms[feeheads_total_val<?php echo $categories['fee_category_id'];?>][]" id="feeheads_total_val<?php echo $j;?>" /> 
						</td>
                <?php } ?>
                                                            </tr>

                                                            <?php
                                                        }
                                                        $j++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td bgcolor="#ccf5ff"></td>
                                                        <td bgcolor="#ccf5ff" style="text-align:right;"><?php echo 'Total ' . $letters[$i] . ' (Rs.)'; ?></td>
                                                        <?php
                                                        $TermItems_model = $feestructures;
                                                        $category_id = $categories['fee_category_id'];
														//echo $structures_id; die();
                                                        $terms1_total = $TermItems_model->getamountbycat12($structures_id, $category_id, $term_data[0]['cmn_terms']);
                                                        ?>
                                                        <?php $check = array();?>
                                                        <?php foreach ($term_data as $key => $term_details) { ?>
                                                            <?php $inc = $key + 1; ?>
                                                    <?php $termsmy_total = $TermItems_model->getamountbycat($structures_id, $category_id, $term_data[$key]['cmn_terms']); ?>
                                                     
                                                          <?php //print_r($termsmy_total); die();?>
                                                            <td bgcolor="#ccf5ff" style="text-align:left;"><?php echo $termsmy_total['totcat']; ?></td>
                                                        <?php } ?>
                                                        <td style="text-align: center;"><?php echo $terms1_total['total_cat_value']; ?></td>
                                                        
                                                    </tr>
                                                <input type="hidden" name="terms[count_i][]" id="count_i" value="<?php echo $i; ?>" />
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                            <tr>
                                                <td bgcolor="#b3ecff"></td>
                                                <td bgcolor="#b3ecff" style="text-align:right;"><?php
                                                    $lets = "";
                                                    $cats = count($feescategorys);

                                                    for ($l = 0; $l < $cats; $l++) {
                                                        $lets = $lets . $letters[$l] . '+';
                                                    }
                                                    echo 'Grand Total (' . rtrim($lets, '+') . ') (Rs.)';
                                                    ?></td>
                                                <?php
                                                $items_result = $result1;
                                                if (!empty($items_result)) {
                                                    ?>	  <?php foreach ($term_data as $key => $term_details) { ?>
                                                        <?php $inc = $key + 1; ?>
                                                        <td bgcolor="#b3ecff" style="text-align:left;"><?php echo $items_result["grand_term" . $inc . "_result"]; ?></td>
                                                    <?php } ?>
                                                    <td bgcolor="#b3ecff" style="text-align:center;"><?php echo $items_result['total_grand_value']; ?></td>
    <?php } else {
        ?>
                                                    <td bgcolor="#b3ecff" style="text-align:right;"><span id="term1_grandtotal_" ></span>
                                                        <input type="hidden" name="terms_fee[grand_result1][]" id="grand_result1" value="0"/></td>
                                                    <td bgcolor="#b3ecff" style="text-align:right;"><span id="term2_grandtotal_" ></span>
                                                        <input type="hidden" name="terms_fee[grand_result2][]" id="grand_result2" value="0" /></td>
                                                    <td bgcolor="#b3ecff" style="text-align:right;"><span id="term3_grandtotal_" ></span>
                                                        <input type="hidden" name="terms_fee[grand_result3][]" id="grand_result3" value="0" /></td>
                                                    <td bgcolor="#b3ecff" style="text-align:right;"><span id="term4_grandtotal_" ></span>
                                                        <input type="hidden" name="terms_fee[grand_result4][]" id="grand_result4" value="0" /></td>
                                                    <td bgcolor="#b3ecff" style="text-align:right;"><span id="term5_grandtotal_" ></span>
                                                        <input type="hidden" name="terms_fee[grand_result5][]" id="grand_result5" value="0" /></td>
                                                    <td bgcolor="#b3ecff" style="text-align:center;"><span id="grand_total" ></span>
                                                        <input type="hidden" name="terms_fee[grandtotal_total][]" id="grandtotal_total" value="0"/></td>
                                                       
                                            <?php } ?>
                                            </tr>
                                        <?php } else {
                                            ?>
                                            <tr><td colspan="8"><center><strong>No Data Available</strong></center></td></tr>  
<?php } ?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <div id="instalmentModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
        <p class="text-right"><b>Total Amount :- </b><span class="amountSpan"></span></p>
      </div>
      <div class="modal-body">
        
        
        	<input type="hidden" name="count_val" id="count_val" value="1" class="count_val">
	
<div class="row">
	<div class="col-sm-2"><div class="form-group"><label class="control-label">Installment Amont</label><input type="text" name="installment[]"  class="form-control" /></div></div>
	

							<div class="col-md-offset-2 col-md-2"><a  class="removeclass btn btn-primary remove_class " style="margin:24px 15px;padding:7px 15px;" href="#">-</a></div></div>

			<div id="fields"></div>
					<div class="col-md-offset-2 col-md-2"></div><input type="button" value="+" style="margin:24px 15px;padding:7px 15px;" id="AddButton" class="btn btn-primary" > 	
					

					
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    </div>
</td>
</tr>
</tr>

<script>


 $(".close_tr").click(function () {
         //alert('hii');
        $(".feeclose").hide();
        //$("#instalmentModal").remove();
    });
</script>


