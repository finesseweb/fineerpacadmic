<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Head</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url()?>feestructure/update/<?= $feesstructures['fee_structure_id'] ?>">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Academic Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="academic_year_id" required>
                                        <?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>" <?= ($feesstructures['academic_year_id']==$academic['academic_year_id']) ? 'selected' : '' ?>><?= $academic['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
					<div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cast Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="caste_category_id" required>
                                        <?php foreach ($castcategorys as $castcategory): ?>
                                            <option value="<?= $castcategory['caste_category_id'] ?>" <?= ($feesstructures['caste_category_id']==$castcategory['caste_category_id']) ? 'selected' : '' ?>><?= $castcategory['caste_category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    	
					 <div class="row">
						 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Course</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="course_id" required>
									<option value="">Select</option>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?= $course['course_id'] ?>" <?= ($feesstructures['course_id']==$course['course_id']) ? 'selected' : '' ?>><?= $course['course_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">College</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="college_id" required>
                                        <?php foreach ($colleges as $college): ?>
                                            <option value="<?= $college['college_id'] ?>" <?= ($feesstructures['caste_category_id']==$college['college_id']) ? 'selected' : '' ?>><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
					<div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" required>
                                        <option value="active" <?= ($feesstructures['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($feesstructures['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
					</div>
					 <div class="row">
					 <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Particulars</th>
								<?php 
								//global  $amountfees ;
								$total_cat=0;
								 $term1_cat_tot = 0;
                                 $term2_cat_tot = 0;
                                 $term3_cat_tot = 0;
                                 $term4_cat_tot = 0;
                                 $term6_cat_tot = 0;
								$semesters=$semesters->GetDataByAcademic($feesstructures['academic_year_id']);
								foreach($semesters as $semester) {?>
							    <input type ="hidden" value="<?= $semester['cmn_terms']; ?>" name='term_id[]' > 
								<th><?=$semester['semester_name']?></th>
								<?php }?>
                               
                            </tr>
							<tbody>
							<?php $i=0;
							$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
							foreach($feescategorys as $feescategory) {?>
							<tr>
							<td><?php echo $letters[$i]?></td>
							<td><input type="hidden" name="terms[category_id][]" id="category_id" value="<?php echo $feescategory['fee_category_id']; ?>" />
							     <?=$feescategory['fee_category_name']?></td>
							</tr>
							<?php $m=1;//$heads= $feeheadmodel->gethead($feescategory['fee_category_id']);
							foreach($heads as $head) {
								 if ($feescategory['fee_category_id'] == $head['fee_category_id']) {
							    
							?>
							<tr>
							<td><?=$m?><input type="hidden" name="terms[fee_head_id][]" value="<?=$head['fee_head_id']?>" ></td><td><?=$head['fee_head_name']?></td>
							<?php 	$j=1;foreach($semesters as $key => $semester) {  ?>
						     
							
							<td>
							<?php $amountfees=$feesdetails->getamountbyhead($feesstructures['fee_structure_id'],$feescategory['fee_category_id'],$head['fee_head_id'],$semester['cmn_terms']);
							
							?>
							<?php if($amountfees) $term1_cat_tot += $amountfees['amount']; ?>
							<input type="text" name="amount_<?php echo $feescategory['fee_category_id']; ?>_<?php echo $head['fee_head_id']; ?>_<?=$j?>" id="term<?=$m?>_<?=$j?>" onchange="select_term_fees(this.val,<?php echo $m; ?>,<?php echo $i; ?>,<?php echo $feescategory['fee_category_id']; ?>,<?php echo $j; ?>)" class="form-control term<?= $j; ?><?php echo $feescategory['fee_category_id']; ?>" value="<?php if($amountfees){ echo  $amountfees['amount']; } else { }; ?>"></td>
							<?php $j++;}
                             $headamount=$feesdetails->getamountbyheadID($feesstructures['fee_structure_id'],$feescategory['fee_category_id'],$head['fee_head_id']);
							  
                                     
							?>
							<td><span id="feeheads_total<?php echo $m; ?>"><?php if($headamount) echo $headamount['fee_head_total']; ?> </span>
                            <input type="hidden" name="terms[feeheads_total_val<?php echo $feescategory['fee_category_id']; ?>][]" id="feeheads_total_val<?php echo $m; ?>" value="<?php echo!empty($term1_result['feeheads_total']) ? $term1_result['feeheads_total'] : 0; ?>" /> 
                            </td>
							</tr>
							<?php } $m++;}?>
							<tr><td colspan="2"> Total Amount</td>
							<?php $k=1;foreach($semesters as $semester) {
							    
							  $amountfees1=$feesdetails->getamountbycat($feesstructures['fee_structure_id'],$feescategory['fee_category_id'],$semester['cmn_terms']);
							// print_r($amountfees1); die();
							   ?>
							
							<td>
							<span id="term<?= $k; ?>_total_<?php echo $feescategory['fee_category_id']; ?>_<?php echo $i; ?>" class="term<?= $k; ?>"><?php if($amountfees1){ echo  $amountfees1['totcat']; } else { }; ?></span>
							<input type="hidden" name="terms[total_cat_value_<?=$k?>][]" id="catresult<?=$k?><?php echo $feescategory['fee_category_id']; ?>" value="<?php if($amountfees1){ echo  $amountfees1['totcat']; } else { }; ?>" class="form-control" readonly></td>
							
							<?php  $k++;} 
							
							$catamount=$feesdetails->getamountbycatID($feesstructures['fee_structure_id'],$feescategory['fee_category_id'],$semesters[0]['cmn_terms']);
							
							  //$k++ ///;endforeach;?>
							<td bgcolor="#ccf5ff" style="text-align:right;"><span id="cat_total<?php echo $feescategory['fee_category_id']; ?>_<?php echo $i; ?>" style="text-align:right;"><?php if($catamount) echo $catamount['total_cat_value']; ?></span>
                             <input type="hidden" name="terms[cat_row_total<?php echo $feescategory['fee_category_id']; ?>_<?php echo $i; ?>]" id ="cat_row_total<?php echo $feescategory['fee_category_id']; ?>_<?php echo $i; ?>" value="<?php echo!empty($catamount['total_cat_value']) ? $catamount['total_cat_value'] : 0; ?>" /></td>
                                                          
							</tr>
							<?php  $i++;} //$k++ ///;endforeach;?>
							<tr><td colspan="2"> Grand Total Amount</td>
							<?php 	$n=1;foreach($semesters as $semester) :
							   $semester="t".$n; ?>
						     
							<td>
							<span id="term<?= $n; ?>_grandtotal_" ><?php //echo $feesstructures["total_grand_value".$n]; ?></span>
							<input type="hidden" id="grand_result<?= $n; ?>" name="terms_fee[grand_result<?=$n?>][]" value="" class="form-control" readonly></td>
							<?php $n++; endforeach; ?>
							 <td bgcolor="#b3ecff" style="text-align:right;">
							 <span id="grand_total" ><?php //echo $feesstructures['total_grand_value1']; ?></span>
                              <input type="hidden" name="terms_fee[grandtotal_total][]" id="grandtotal_total" value="<?php //echo!empty($feesstructures['total_grand_value1']) ? $feesstructures['total_grand_value1'] : 0; ?>"/></td>
                                                     
							</tr>
							</tbody>
                        </thead>
					 </table>
					 </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    <a href="<?= base_url()?>feestructure" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
