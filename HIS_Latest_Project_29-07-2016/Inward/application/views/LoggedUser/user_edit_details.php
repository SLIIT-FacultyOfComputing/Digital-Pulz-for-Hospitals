<br/>
<br/>

<?php echo form_open('Inward/LoggedUser/UpdateLoggedUserDetails'); ?>

            <form role="form">  
                <div class="modal-body">
                    <div class="col-lg-16">


                        <div class="form-group" style="display: none;"> 
                            <input id="userIdText" name="userIdText" class="form-control" placeholder="Enter text" required="required" value=<?php echo $userId ?> ></input>
                        </div> 
                        
                        <div class="form-group" style="display: none;">
                            <label for="userName">Role :</label>
                            <input id="roleText" name="roleText" class="form-control" placeholder="Enter role Name" value= <?php echo $roleId ?> ></input>
                        </div>
                        
                        <div class="form-group" style="display: none;">
                            <label for="employee">Employee :</label>
                            <select id="employee_list" name="employee_list" class="form-control" placeholder="Select Employee" required="required"  >
                                <?php
                                foreach ($employees as $row) {
                                 ?>
                                <?php
                                    echo ' <option value= '.$row->emp_ID.'   > '. $row->first_name . ' ' . $row->last_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>    
                        <div class="form-group">
                            <label for="userName">User Name :</label>
                            <input id="uNameText" name="uNameText" class="form-control" placeholder="Enter User Name" required="required" value= <?php echo $userName?> ></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <input type="submit" id="updateEmployeeButton" name="updateEmployeeButton" class="btn btn-primary" value="Update user details"/>
                    </div>
                </div>
            </form>
        
<?php echo form_close(); ?>
                        <hr/>
                        
                        <?php echo form_open('LoggedUser/UpdateLoggedUserPassword'); ?>

            <form role="form">  
                <div class="modal-body">
                    <div class="col-lg-16">
                         <div class="form-group" style="display: none;"> 
                            <input id="userId" name="userId" class="form-control" placeholder="Enter text" required="required" value=<?php echo $userId ?> ></input>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password :</label>
                            <input type="password" id="passwordText" name="passwordText" class="form-control" placeholder="Enter Password" required="required" value=''  ></input>
                        </div>

                        <div class="form-group">
                            <label for="Confirm password">Confirm Password :</label>
                            <input type="password" id="confirmPasswordText" name="confirmPasswordText" class="form-control" placeholder="Password again" required="required" value='' ></input>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Old Password :</label>
                            <input type="password" id="oldPasswordText" name="oldPasswordText" class="form-control" placeholder="Old Password" required="required" value=''  ></input>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" id="viewPermission" name="<?php echo $userId ?>" class="btn btn-primary" data-dismiss="modal" value="View Special Permission" style="display: none;"/>
                        
                        <input type="submit" id="updateEmployeeButton" name="updateEmployeeButton" class="btn btn-primary" value="Update/Change password"/>
                    </div>
                </div>
            </form>
        
<?php echo form_close(); ?>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="js/sb-admin.js"></script>



<script>
    $(document).ready(function() {
       
        $("#viewPermission").click(function() {
                    var uId = $(this).attr('name');
                       // alert(rId);
//                        $.ajax({
//                        type: 'post',
//                        url: 'RolePermission/LoadViewPermission',
//                        data: {
//                            UId: rId,
//                                    //$('#userIdText'+rId).val(),
//                            RId: $('#roleText').val()
//                        },
//                        dataType: 'text',
//                        cache: false,
//                        success: function(output) {

                            //alert(JSON.stringify(output[1]));  
        //                    if (output[1] == 'TRUE')
        //                    {
                                window.location = "Role_Permission/"+uId+"/"+$('#roleText').val();
        //
        //                    }

//                        }
//                    });
                });
        
    });
</script>