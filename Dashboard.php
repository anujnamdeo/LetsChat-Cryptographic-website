<?php
session_start();
require_once 'include/constants.php';
require_once 'userListAction.php';
require_once 'include/connection.php';
require_once 'include/getPrivilegeLvl.php';

//ADdedby me
$temp = mysqli_query($link, "UPDATE `usertbl` SET `privilege_lvl` = '2' WHERE `usertbl`.`username` = '" . $_SESSION["session_username"] . "'");
$result1 = mysqli_query($link, $temp);
//till here

if (!isset($_SESSION["session_username"]) || GetPrivilegeLvl($link) < DB_BLOCKED_USER_PRIVILEGE_LVL) :
  //var_dump($_SESSION); 
  header("location:login.php");
else :

endif;

require_once 'include/header.php'; ?>
<p>
  <?php
    $uu = $_SESSION["session_username"];
    echo "You are logged in as: ". $uu;

  ?>
</p>
<form class="m-5" method="post" action="">
  <div class="form-row mb-4 ml-1">
    <div class="btn-group" name="apply" role="group">
      <button type="submit" name="operation" value="block" class="btn btn-secondary"><i class="fas fa-ban"></i> Block</button>
      <button type="submit" name="operation" value="unblock" class="btn btn-secondary"><i class="fas fa-unlock"></i> Unblock</button>
      <button type="submit" name="operation" value="delete" class="btn btn-secondary"><i class="fas fa-trash"></i> Delete</button>
    </div>
  </div>
  <div class="form-row">
    <div class="container-fluid">
      <table id="tuser" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th width="5%">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span>
                    <input type="checkbox" class="select-all form-control-default" aria-describedby="inputGroup-sizing-lg">
                  </span>
                </div>
              </div>
            </th>
            <th width="25%"><span>Nickname</span></th>
            <th width="35%"><span>Registration date</span></th>
            <th width="35%"><span>Last online date</span></th>
          </tr>
        </thead>
        <tbody>
          <?php include("userlist.php"); ?>
        </tbody>
      </table>
    </div>
  </div>
</form>

<?php include("include/footer.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>


<script>
  //column checkbox select all or cancel
  $("input.select-all").click(function() {
    var checked = this.checked;
    $("input.select-item").each(function(index, item) {
      item.checked = checked;
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#tuser').DataTable({
      "searching": true,
      "paging": true,
    });
  });
</script>