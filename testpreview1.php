<?php
include "inc/header1.php";
include "inc/nav1.php";
?>

<div class="container form-group">
    <form method="post" action="testsubmit.php">

        <div class="col-md-12 p-5 table-responsive">
            <h4 class="text-center">Test Form Preview</h4>
            <table class="table table-bordered text-nowrap">
                <tr>
                    <td width="10%">Name:</td>
                    <td>
                        <?php echo $_POST['testname']; ?>
                        <input type="hidden" name="testname" value="<?php echo $_POST['testname']; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%">Photo:</td>
                    <td>
                        <?php echo $_POST['testimg']; ?>
                        <input type="hidden" name="testimg" value="<?php echo $_POST['testimg']; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%">Mobile:</td>
                    <td>
                        <?php echo $_POST['testmobile']; ?>
                        <input type="hidden" name="testmobile" value="<?php echo $_POST['testmobile']; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%">Email address:</td>
                    <td>
                        <?php echo $_POST['testemail']; ?>
                        <input type="hidden" name="testemail" value="<?php echo $_POST['testemail']; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%">District:</td>
                    <td>
                        <?php echo $_POST['testdistrictddl']; ?>
                        <input type="hidden" name="testdistrictddl" value="<?php echo $_POST['testdistrictddl']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="text" name="captcha" id="captcha" placeholder="Captcha" class="form-control" required>
                        <p><br />
                            <img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
                        </p>
                        <p>
                            <a href='javascript: refreshCaptcha();'>Refresh</a>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
        <div align="center">
            <a href="test.php" class="btn btn-danger">
                <-- BACK to TEST FORM</a>
                    <button type="submit" class="btn btn-success" name="testsubmit">SUBMIT</button>
        </div>
    </form>
</div>


<?php include "inc/footer.php"; ?>
<script>
//Refresh Captcha
function validateForm() {
  let x = document.forms["form"]["captcha"].value;
  if (x == "") {
    alert("Please enter captcha..!");
    return false;
  }
}

function refreshCaptcha(){
    var img = document.images['captcha_image'];
    img.src = img.src.substring(
		0,img.src.lastIndexOf("?")
		)+"?rand="+Math.random()*1000;
}
</script>
<?php include "inc/script1.php"; ?>
