<?php
include ("heder.php");

?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-table"></i> Cars</h2>
                   </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New Car
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" method="POST">
                                            <div class="form-group">
                                                <label>Car Name</label>
                                                <input type="text" placeholder="Please Enter Car Name " name="Carname" class="form-control" />
                                        </div>
                                            <div class="form-group">
                                                <label>Car Description</label>
                                                <input type="text" class="form-control" name="description"  placeholder="PLease Description" />
                                         </div>
                                            <div class="form-group">
                                                <label>Car Image</label>
                                                <input type="file" class="form-control" name="image" />
                                          </div>
                                      
                                            <div class="form-group">
                                                <label>Car Type</label>
                                                <select class="form-control" name="type">
                                                <option>sport</option>
                                                <option>sport</option>
                                                <option>sport</option>
                                                </select>
                                            
                                            </div>
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary">Add User</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-table"></i> Cars
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>price</th>
                                                    <th>Type</th>
                                               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
                                                <td>1</td>
                                                    <td>KIA</td>
                                                    <td>cccccccccccccccccccccccccc</td>
                                                    <td>4000$</td>
                                                    <td >ssss</td>

                                                    <td>
                                                        <a href="" class='btn btn-success'>Edit</a>
                                                        <a href="" class='btn btn-danger' id="delete">Delete</a>
                                                    </td>
                                                </tr>

                                            </tbody>
                             
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        
                    </div>
             
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   
   <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>