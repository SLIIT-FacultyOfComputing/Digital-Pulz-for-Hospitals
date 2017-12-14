
        <div class="tables">
            <!--class="table table-bordered table-striped table-hover" -->
            <table style="width: 100%;"   class="table table-hover table table-striped" >
                <col style="width: 22%;">
                <col style="width: 23%;">
                <col style="width: 23%;">
              <!--  <col style="width: 23%;">-->
                <col style="width: 3%;">
                <col style="width: 3%;">
                <col style="width: 3%;">

                <thead>
                    <tr >

                        <th  style="text-align: center;" >Ward No</th>
                        <th  style="text-align: center;">Category</th>
                        <th  style="text-align: center;">Ward Gender Type</th>
        <!--		<th >No of Beds</th>-->
                        <th  style="text-align: center;" colspan="3"></th>


                    </tr>
                </thead>
                <?php
                foreach ($Wards as $value) {
                    ?>
                    <tr style="text-align: center;  ">

                        <td style=" vertical-align: middle"><?php echo $value->wardNo; ?></td>
                        <td style=" vertical-align: middle"><?php echo $value->category; ?></td>
                        <td style=" vertical-align: middle"><?php echo $value->wardGender; ?></td>
                    <!--    <td><?php // echo $value->noOfBed;  ?></td>-->

                        <td style=" vertical-align: middle">
                            <?php echo form_open('inward/wardManageC/wardView'); ?>
                            <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>" />
                        <!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="View" name="btnSubmit" style="width: 5em;" >-->
                            <!--    <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="View">View
                                    <span class="glyphicon glyphicon-search"></span>
                                    </button>-->
                            <button  type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View">
                                <span  class="glyphicon glyphicon-search">View</span>
                            </button>
                            <?php echo form_close(); ?>
                        </td>

                        <td style=" vertical-align: middle">
                            <?php echo form_open('inward/wardManageC/UpdateWardView'); ?>
                            <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>" />
                            <?php //echo anchor('Update');  ?>
                        <!--    <input type="submit" class="btn btn-large btn-info msgbox-confirm" value="Update" name="btnSubmit" style="width: 5em;" >-->
                            <!--        <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit">Edit
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    </button>-->


                            <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                                <span  class="glyphicon glyphicon-pencil">Edit</span>
                            </button>
                            <?php echo form_close(); ?>
                        </td>


                        <td style=" vertical-align: middle">
                            <?php echo form_open('inward/wardManageC/RemoveWard'); ?>
                            <input type="hidden" id="wardNo" name="wardNo" value="<?php echo $value->wardNo; ?>" />
                    <!--        <input onclick="return confirm('Are you sure want to delete the Ward?');" type="submit" class="btn btn-large btn-info msgbox-confirm" value="Delete" name="btnSubmit" style="width: 5em;" />-->

                            <!--        <button type="submit" class="btn btn-default" onclick="return confirm('Are you sure want to delete the Ward?');" data-toggle="tooltip" data-placement="top" title="Delete">Delete
                                    <span class="glyphicon glyphicon-trash"></span>
                                    </button> -->

                            <button class="btn btn-danger btn-xs"  type="submit"  onclick="return confirm('Are you sure want to delete the Ward?');" data-toggle="tooltip" data-placement="top" title="Delete">
                                <span  class="glyphicon glyphicon-trash">Delete</span>
                            </button>


                            <?php echo form_close(); ?>
                            <?php //echo anchor('inward/wardManageC/RemoveWard/'.$item['wardNo'],'Delete'); ?>

                        </td>


                    </tr> 

                    <?php
                }
                ?>
            </table>
        </div>
    </div>
