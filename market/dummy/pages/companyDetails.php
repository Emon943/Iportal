<?php include("header.php");
$username = $auth->getUsername($_COOKIE['auth_session']);

$user = $auth->getUserData($username);

$userid = $user['uid'];

date_default_timezone_set('Asia/Dhaka');

$newdate = date('Y-m-d', time());

$portfolio_id = $_GET['id'];

$_SESSION['portfolio_id'] = $portfolio_id;

$time = date('H:i:s');?>

<table class="table table-bordered">
      <thead>
        <tr>
          <th rowspan="2">Company Name</th>
          <th rowspan="2">Category</th>
          <th rowspan="2">52 Week's Range</th>
          <th rowspan="2">Face Value </th>
          <th rowspan="2">Market Lot</th>
          <th rowspan="2">Total Shares</th>
          <th rowspan="2">Business Segment</th>
          <th rowspan="2">Reserve & Surplus</th>
          <th rowspan="2">Year End</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php $query = getCompanyInfo($userid,$portfolio_id);

    while ($info = mysql_fetch_array($query)) {?>
          <td><?php echo $info['name'];?></td>
          <td><?php echo $info['category'];?></td>
          <td>-</td>
          <td><?php echo $info['face_value']; ?></td>
          <td><?php echo $info['market_lot']; ?></td>
          <td><?php echo number_format($info['total_share'],2); ?></td>
          <td>-</td>
          <td>-</td>
          <td><?php echo $info['year_end']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
 <?php include("footer.php");  ?>