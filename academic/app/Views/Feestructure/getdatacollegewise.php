
   
                            <?php $slNo = 1; ?>
                            <?php
                            
							foreach ($feestructures as $feestructure): ?>
                                <tr class="structid<?php echo $feestructure['fee_structure_id']; ?>" >
                                    <td><?= $slNo++ ?></td>
									<td><?= $feestructure['academic_year_code']?></td>
                                    <td><?= $feestructure['course_name']?></td>
									 <td><?= $feestructure['college_name'] ?></td>
									 <td><?= $feestructure['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="<?= base_url()?>feestructure/edit/<?= $feestructure['fee_structure_id'] ?>">
                                            <i class="mdi mdi-file-check btn-icon-append">Edit</i>
                                        </a>
										<a href="#" class="btn btn-primary btn-rounded btn-icon-text showhidedetails" structid="<?php echo $feestructure['fee_structure_id']; ?>" data-id="<?php echo $feestructure['fee_structure_id']; ?>"> <i class="mdi mdi-file-check btn-icon-append">View</i></a>
                                        <!-- <a href="#" class=" btn btn-primary btn-rounded btn-icon-text" id="showbtndetails"> <i class="mdi mdi-file-check btn-icon-append">Hide</i></a>
                                       Other table data -->
                                    </td>
								
									
                                </tr>
							
							<?php endforeach; ?>
                            <?php //endforeach; ?>
							
<script>

$(".showhidedetails").click(function () {

        var id = $(this).attr("structid");
//alert(id);
        $.ajax({

            type: "POST",

            url: "<?= base_url()?>feestructure/ajaxGetFeeDetailsView",

            data: {id: id}

        }).done(function (data) {

            $(".feeclose").hide();
//$("tr.structid"+id).empty()
            $(data).insertAfter("tr.structid" + id);

        });

    });
</script>