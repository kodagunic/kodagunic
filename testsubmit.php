<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: test.php' ) );
    }
?>
<?php
include "inc/header1.php";
include "inc/nav1.php";
include "inc/conn.php";
?>
<script type="text/javascript">
    document.onkeydown = function(event) {
        if(event.keyCode==116){
            event.preventDefault();
        }
    }
</script>
<?php

if (isset($_POST['testsubmit'])) {
    $name = $_POST['testname'];
    $mobile = $_POST['testmobile'];
    $email = $_POST['testemail'];
    $district = $_POST['testdistrictddl'];

    $checkrefid = "select * from test ORDER BY refid DESC LIMIT 1";
    $checkresult = pg_query($db1, $checkrefid);
    $numrow = pg_num_rows($checkresult);
    if ($numrow > 0) {
        if ($row = pg_fetch_assoc($checkresult)) {
            $uid = $row['refid'];
            $get_numbers = str_replace("KDGVA", "", $uid);
            $id_increase = $get_numbers + 1;
            $id = "KDGVA" . $id_increase;
            $checkemail = "select * from test where email = '$email'";
            $checkemailresult = pg_query($db1, $checkemail);
            $numr = pg_num_rows($checkemailresult);
            if ($numr > 0) {
                echo $email . " already in DB";
            } else {
                $insert_test_qry = "insert into test(refid,name,mobile,email,district_code) values ('$id','$name','$mobile','$email','$district')";
                if ($result = pg_query($db1, $insert_test_qry)) {
                    echo  '<div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Data Inserted Successfully
                                </div>';
                    $select_test_qry = "select test.refid,test.name,test.mobile,test.email,district_karnataka.district_name_eng,district_karnataka.district_name_kan
                        from public.test
                        inner join public.district_karnataka on test.district_code=district_karnataka.district_code  where test.refid = '$id'";
                    $r = pg_query($db1, $select_test_qry);
?>
                    <div class="col-md-12 p-5 table-responsive">
                        <h4 class="text-center">Test Form Submitted Values</h4>
                        <table class="table table-bordered" id="testab">
                            <?php while ($row = pg_fetch_assoc($r)) { ?>
                                <tr>
                                    <td width="10%">Reference ID</td>
                                    <td>:
                                        <strong><?php echo $row["refid"]; ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%">Name</td>
                                    <td>: <?php echo $row["name"]; ?></td>
                                </tr>
                                <tr>
                                    <td width="10%">Mobile</td>
                                    <td>: <?php echo $row["mobile"]; ?></td>
                                </tr>
                                <tr>
                                    <td width="10%">Email address</td>
                                    <td>: <?php echo $row["email"]; ?></td>
                                </tr>
                                <tr>
                                    <td width="10%">District/ಜಿಲ್ಲೆ</td>
                                    <td>: <?php echo $row["district_name_eng"]; ?>/<?php echo $row["district_name_kan"]; ?></td>
                                </tr>
                        </table>

                    </div>

        <?php
                            }
                        } else {
                            echo "error";
                        }
                    }
                }
            } else {
                $id = "KDGVA2022000001";
                $insert_test_qry = "insert into test(refid,name,mobile,email,district_code) values ('$id','$name','$mobile','$email','$district')";
                if ($result = pg_query($db1, $insert_test_qry)) {
                    echo  '<div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Data Inserted Successfully
                                </div>';
                    $select_test_qry = "select test.refid,test.name,test.mobile,test.email,district_karnataka.district_name_eng,district_karnataka.district_name_kan
                        from public.test
                        inner join public.district_karnataka on test.district_code=district_karnataka.district_code  where test.refid = '$id'";
                    $r = pg_query($db1, $select_test_qry);
        ?>
        <div class="col-md-12 p-5 table-responsive">
            <h4 class="text-center">Test Form Submitted Values</h4>
            <table class="table table-bordered" id="testab">
                <?php while ($row = pg_fetch_assoc($r)) { ?>
                    <tr>
                        <td width="10%">Reference ID</td>
                        <td>:
                            <strong><?php echo $row["refid"]; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">Name</td>
                        <td>: <?php echo $row["name"]; ?></td>
                    </tr>
                    <tr>
                        <td width="10%">Mobile</td>
                        <td>: <?php echo $row["mobile"]; ?></td>
                    </tr>
                    <tr>
                        <td width="10%">Email address</td>
                        <td>: <?php echo $row["email"]; ?></td>
                    </tr>
                    <tr>
                        <td width="10%">District/ಜಿಲ್ಲೆ</td>
                        <td>: <?php echo $row["district_name_eng"]; ?>/<?php echo $row["district_name_kan"]; ?></td>
                    </tr>
            </table>

        </div>
<?php
                    }
                } else {
                    echo "error";
                }
            }
        }
?>
<p>
    <input type="button" value="Print Table" onclick="myApp.printTable()" />
</p>
<script>
    var myApp = new function() {
        this.printTable = function() {
            var tab = document.getElementById('testab');
            var win = window.open('', '', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
</script>

<?php include "inc/footer.php"; ?>
<?php include "inc/script1.php"; ?>