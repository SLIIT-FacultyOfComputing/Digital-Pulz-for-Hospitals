       
<div class="panel panel-primary" >
    <div class="panel-heading" style="background-color:whitesmoke">
        <h4 class="panel-title" style="color:#428BCA">Patient History Details</h4>
    </div>
    <div class="panel-body">

        <table style="width: 100%;" class="table table-hover">
            <thead>
                <tr>

                   


                </tr>
            </thead>
            <?php
            date_default_timezone_set("Asia/Colombo");
           
                ?>

           <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">Name</label>
                <div class="col-xs-4">
                    <input id="remark" name="name" class="form-control" type="text" />
                </div>
            </div>
            <div class="form-group">
                <br/>
                <label style="color: #797979;" class="col-sm-3 control-label">HIN</label>
                <div class="col-xs-4">
                    <input id="remark" name="hin" class="form-control" type="text" />
                </div>
            </div>
              
            <br>
             <button name="btnSubmit" type="submit" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Search Patient">
                <span   class="glyphicon glyphicon-search">Search</span>
            </button>
           
            
            <br>&nbsp;&nbsp;&nbsp;
          
            
            
        <div class="panel-heading" style="background-color:whitesmoke">
                <h4 class="panel-title" style="color:#428BCA">Patient Details</h4>
            </div>
            <div class="panel-body">
                <div class="panel-body" id="panel2">


                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Patient ID : </label> 
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Full Name : </label> 
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > NIC No: </label> 
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Gender : </label> 
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Date of Birth : </label>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Civil Status : </label>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Preferred Language : </label>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Full Name : </label>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Address: </label>
                        </div>                                
                    </div>


                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <label for="bhtNo" > Telephone : </label>
                        </div>
                                             
                    </div>


                </div>
            </div>
                    
            
            
           
            
            
            <br>&nbsp;&nbsp;&nbsp;
            <br>&nbsp;&nbsp;&nbsp;
            <div> <a href="">Download</a></div>
           
   
            
                <?php
            
            ?>

        </table>
    </div>
</div>

