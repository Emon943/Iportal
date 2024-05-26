<?php include("header.php"); ?>

<div class="row header">

<div class="col-md-6">

space for logo

</div>

	<div class="col-md-6 col-lg-6 col-sm-6">

    <div class="clearfix pull-right">

<a href="?page=change-password" class="btn btn-warning btn-sm "><i class="glyphicon glyphicon-lock"></i>  Change Password</a>

	<a href="?page=change-email" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-envelope"></i>  Change Email</a>

	<a href="?page=logout" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-off"></i>  Logout</a>

	</div>

    </div>

</div>

<div class="row">

<div class="col-md-12">

<div class="jumbotron">

	<h2>Hello and welcome to CAPM Contest!</h2>

	<h5>You're currently logged in as <strong><?php echo $auth->getUsername($_COOKIE['auth_session']); ?></strong>.</h5> 

    <!---describe the table here-->

    

</div>

</div>

</div>
<center><h3>Currently Running Contests</h3></center>

<div class="row">

<div class="col-md-12">
<div class="table-responsive">

<table class="table">

<thead>

<tr>

<th>Contest Name</th>

<th>Contest Type</th>

<th>Contest Amount</th>

<th>Contest Start Date</th>

<th>Contest End Date</th>



</tr>

</thead>

<tbody>

<tr>

<?php $query = getCurrentContest();// Get contest List of curretn Month				

while($info = mysql_fetch_array($query)) {

?>          			



						<td><a href="?page=contestDetails&id=<?php echo urlencode($info['ID']); ?>&name=<?php echo urlencode($info['name']); ?>" title=""><?php echo $info['name']; ?></a></td>

                        <td><?php echo contestType($info['type']); ?></td>

                        <td><?php echo number_format($info['amount']); ?></td>

                        <td><?php $date = $info['start_date']; echo date('jS F Y', strtotime($date)); ?></td>

                        <td><?php $date = $info['end_date']; echo date('jS F Y', strtotime($date)); ?></td>

                       









</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include("footer.php"); ?>