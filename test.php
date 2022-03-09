<?php
    include "inc/header1.php";
    include "inc/nav1.php";
    include "inc/conn.php";
    //include "district/getdistrict.php";    
?>

    <div class="container form-group">
        <form action="testpreview1.php" name="testform" method="post">
        
            <div class="form-group">
                <label for="testname" class="form-label">Name:</label>
                <div class="input-group">
                    <input type="text" name="testname"  class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="testimg" class="form-label">Photo:</label>
                <div class="input-group">
                    <input type="file" name="testimg"  class="form-control" required>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="testmobile" class="form-label">Mobile:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+91</span>
                    </div>
                    <input type="number" name="testmobile"  class="form-control" required>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="testemail">Email address:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <span class="fa fa-envelope" aria-hidden="true"></span> </span>
                    </div>
                    <input type="text" class="form-control" id="testemail" placeholder="Enter email" name="testemail" required>
                    
                                <span id="emailerrmsg"></span>

                </div>
            </div>
            <div class="form-group my-3">
                <label for="testdistrictddl">Select District:</label>
                <div class="form-group">
                    <select name="testdistrictddl" class="form-control">
                        <option value="0" selected="" disabled="">Select District / ಜಿಲ್ಲೆ ಆಯ್ಕೆಮಾಡಿ </option>
                        <?php 
                            $seldist = "select district_code,district_name_eng,district_name_kan from district_karnataka";
                            $sd = pg_query($db1,$seldist);
                            while($row=pg_fetch_assoc($sd)){
                        ?>
                        <option value="<?php echo $row['district_code'] ?>">
                            <?php echo $row['district_name_eng'] ?> / <?php echo $row['district_name_kan'] ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">PREVIEW</button>
            <button type="reset" class="btn btn-danger">CANCEL</button>
        </form>
    </div>    

<?php
    include "inc/footer.php";
    include "inc/script1.php";
?>