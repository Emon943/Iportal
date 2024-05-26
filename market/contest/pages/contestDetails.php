<?php

include("header.php");

		if(isset($_GET['id'])){

  		$contest_id = $_GET['id'];

      $_SESSION['contest_id'] = $contest_id;

			$contest_name = $_GET['name'] ;

		}

$username = $auth->getUsername($_COOKIE['auth_session']);

$user = $auth->getUserData($username);

$userid = $user['uid'];

date_default_timezone_set('Asia/Dhaka');

$newdate = date('Y-m-d h:i:s', time());

?>

<script src="js/vex.combined.min.js"></script> 

<script>vex.defaultOptions.className = 'vex-theme-os';</script>

<link rel="stylesheet" href="css/vex.css" />

<link rel="stylesheet" href="css/vex-theme-os.css" />

<div class="row header">

  <div class="col-md-6"> space for logo </div>

  <div class="col-md-6 col-lg-6 col-sm-6">

    <div class="clearfix pull-right"> <a href="?page=home" class="btn btn-primary btn-sm "><i class="glyphicon glyphicon-home"></i> Home</a> <a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a>

      <?php  $query = checkUser($userid,$contest_id);

             $result = (mysql_num_rows($query));

			 

			 //print_r($query);

                    if($result>0) {

?>

      <a href="?page=portfolio&cid=<?php echo $contest_id?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-briefcase"></i> My Portfolio</a>

      <?php } else {?>

      <button type ="submit" class='join btn btn-success btn-sm has-spinner' name="join" value='<?php echo $userid; ?>'><span class="spinner"><i class="glyphicon glyphicon-refresh "></i></span>JOIN</button>

      <?php }?>

    </div>

  </div>

</div>

<div class="row">

  <div class="col-md-12">

    <h3 class="lead"><?php echo $_GET['name'] . "&nbsp- Participant List"; ?></h3>

  </div>

</div>

<div class="row">

  <div class="col-md-12">

    <table class="table table-responsive table-striped">

      <thead>

        <tr>

          <th>Position</th>

          <th>User Name</th>

          <th>Joining Date</th>

          <th>No. of Shares Holding</th>

          <th>Total Equity</th>

          <th> Portfolio Growth</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <?php $count = 1; $query = participantList($contest_id);// Get contest List of curretn Month				

while($info = mysql_fetch_array($query)) {

?>

          <td><?php echo $count++;?></a></td>

          <td><?php echo $info['user_name']; ?></td>

          <td><?php $date = $info['joining_date']; echo date('jS F Y', strtotime($date));  ?></td>

          <td><?php echo $info['total_shares']; ?></td>

          <td><?php echo number_format($info['total_amount'],2); ?></td>

          <td><?php echo number_format($info['growth']*100,2) ."%"?></td>

        </tr>

        <?php } ?>

      </tbody>

    </table>

  </div>

</div>

<script type="text/javascript">

$(document).ready(function () {

	

// initalize vex modal on click

    $(".join").click(function () {

		    $(this).toggleClass('active');

         contest_id = <?php echo $contest_id; ?>;

         userid    = <?php echo $userid; ?>;

         username  = "<?php echo $username; ?>";

         join_date = "<?php echo $newdate; ?>";

        

        $.ajax({

            type: "POST",

            url: "ajax.php?function=joinContest",

            data: {'contest_id': contest_id, 'userid': userid, 'username':username, 'join_date': join_date},

            dataType: "json",

            async: true,

            success: function(s,x){

                  $(this).html(s);

      },

      		complete: function(){

            vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');

          $(".join").toggleClass('active');

          location.reload();

      }

        });

	});

	

});

</script>

<?php include("footer.php"); ?>

