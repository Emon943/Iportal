<?php include("header.php"); 
$username = $auth->getUsername($_COOKIE['auth_session']);
$user = $auth->getUserData($username);
$userid = $user['uid'];
$time = date('Y-m-d H:i:s');
?>

<script src="js/vex.combined.min.js"></script>
<script>vex.defaultOptions.className = 'vex-theme-os';</script>
<link rel="stylesheet" href="css/vex.css" />
<link rel="stylesheet" href="css/vex-theme-os.css" />
<div class="row header">
  <div class="col-md-2"> <img src="img/logo.png" class="img-responsive" /> </div>
  <div class="col-md-6 pull-right m-t-xs text-right"> <span>Welcome <strong><?php echo $username; ?></strong>!</span> <br/><br/><a href="?page=change-password" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-lock"></i> Change Password</a> <a href="?page=change-email" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-envelope"></i> Change Email</a> <a href="?page=logout" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-off"></i> Logout</a>
   
  </div>
  <div class="col-md-12 divider">
    <hr/>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <h3>My Portfolio</h3>
  </div>
  <div class="col-md-6 text-right m-t-md">
  <button class="btn btn-primary btn-sm" id="createProfile">Create New Portfolio</button>
  </div>
  <div class="col-md-12 portfolio-nav">
  <ul>
  	<li><a href="?page=home"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Portfolio</a></li>
    <li class="active"><a href="#"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;News</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-stats"></i>&nbsp;Market Price</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-link"></i>&nbsp;Indices</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-arrow-up"></i>&nbsp;Todays's Top</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Weekly Top</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-globe"></i>&nbsp;Sector Performance</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-book"></i>&nbsp;Education</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-cog"></i>&nbsp;IPO</a></li>
    <li class="pull-right"><a href="#"><i class="glyphicon glyphicon-flag"></i>&nbsp;Alert</a></li>
  </ul>
  </div>
  
  
  <div class="col-md-12 m-t-md">
      <div class="table-responsive">
      <h4>Recent news about companies in your portfolio</h4>
      <p>See the latest regulatory and other announcements of DSE and CSE</p>
      <table class="table table-striped table-portfolio" id="myTableRow">
        <thead>
          <tr>
            <th>Comapny Name</th>
            <th>News Headline</th>
            <th>Date & Time</th>
            <th>News Type</th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <?php $query = getNews();// Get Portfolio of this user			
while($info = mysql_fetch_array($query)) {
?>
            <td><?php echo (extract_str($info['News_Details'],'',':')); ?> </td>
            <td><?php $str = str_replace((extract_str($info['News_Details'],'',':')),"",$info['News_Details']); 
                  $str = str_replace(":","", $str);
                  $sentence = substr($str, 0, "110");
                  echo $sentence;?></td>
            <td><?php echo date('H:i:s',$info['News_Time']); ?></td>
            <td><?php echo ($info['News_Subject']) ?></td>
            
          </tr>
          <?php } ?>
        </tbody>
      </table>
    
   <!-- <h4 class="m-t-md">Totals</h4>
    <table class="portfolio-totals table text-center">
				<thead><tr>
					<th class="first">Asset Cost</th>
					<th>Asset value</th>
					<th>Net cash</th>
					<th>% change</th>
					<th>Profit / loss</th>
					<th>Total value</th>
				</tr>
                </thead>
				<tbody><tr>
					<td class="first">£69.05</td>
					<td class="change-down">£64.00</td>
					<td>£99,930.95</td>
					<td>-7.31%</td>
					<td class="change-down">£-5.05</td>
					<td>£99,994.95</td>
				</tr>
			</tbody></table>-->
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	$("#createProfile").click(function(){
    vex.dialog.open({
            message: 'Create New Portfolio',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Portfolio Name:</label></div><input name=\"name\" type=\"text\" id=\"name\" required /> </div><div class='col-md-12'><div class='equalize'><label>Initial Investment:</label></div><input name=\"investment\" type=\"text\" id=\"investment\" required /> TK</div><div class='col-md-12'><div class='equalize'><label>Commission Rate:</label></div><input name=\"comm\" type=\"text\" id=\"comm\" placeholder=\".5\" required /> %<br/><p></p>",
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Create'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Cancel'
                })
            ],
            callback: function (data) {
                if (data === false) {
                    return console.log('Cancelled');
                 } else {
                    vex.dialog.alert('Congratulation! your new protfolio is created');
                   
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    create_date = "<?php echo $time; ?>";
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=createPortfolio",
                        data: {
                            'name': data.name,
                            'user': user_id,
                            'investment' :data.investment,
                            'create_date': create_date,
                          	'com_rate' : data.comm,
                            },
                        dataType: "json",
                        async: true,
                        success: function (data) {
                           
                            //console.log(data);
                        },
                        complete: function () {
                            
                            location.reload();
                            
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
	});
//ADD FUND
$(".addFund").click(function(){
    var value = $(this).attr('value');
    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=getBalance",
                        data: {
                            'profile_id':value,
                            'user_id':<?php echo $userid; ?>,
                            
                            },
                        dataType: "json",
                        async: false,
                        success: success
            });//eof ajax 
     function success(data) {
        cur_bal = data.amount;
     }
 
 vex.dialog.open({
            message: 'Add More Fund To Your Portfolio',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Current Balance:</label></div>" + cur_bal +" </div><div class='col-md-12'><div class='equalize'><label>Add More Fund:</label></div><input name=\"fund\" type=\"text\" id=\"fund\" required /> TK</div>",
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Add'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Cancel'
                })
            ],
            callback: function (data) {
                if (data === false) {
                    return console.log('Cancelled');
                 } else {
                    //vex.dialog.alert('New Balance Added');
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=addFund",
                        data: {
                            'user_id': user_id,
                            'fund' :data.fund,
                            'portfolio_id': value,
                               },
                        dataType: "json",
                        async: false,
                        success: function (data) {
                            console.log(data);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
});
// EOF ADD FUND
//Withdraw FUND
$(".withdrawFund").click(function(){
    var value = $(this).attr('value');
    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=getBalance",
                        data: {
                            'profile_id':value,
                            'user_id':<?php echo $userid; ?>,
                            
                            },
                        dataType: "json",
                        async: false,
                        success: success
            });//eof ajax 
     function success(data) {
        cur_bal = data.amount;
     }
 
 vex.dialog.open({
            message: 'Withdraw Fund From Your Portfolio',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Current Balance:</label></div>" + cur_bal +" </div><div class='col-md-12'><div class='equalize'><label>Withdraw Amount:</label></div><input name=\"withdraw\" type=\"text\" id=\"withdraw\" required /> TK</div>",
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Withdraw'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Cancel'
                })
            ],
            callback: function (data) {
                if (data === false) {
                    return console.log('Cancelled');
                 } else {
                    //vex.dialog.alert('New Balance Added');
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=withdrawFund",
                        data: {
                            'user_id': user_id,
                            'fund' :data.withdraw,
                            'portfolio_id': value,
                               },
                        dataType: "json",
                        async: false,
                        success: function (data) {
                            console.log(data);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
});//EOF Withdraw Fund
//Edit Profile
$(".editPortfolio").click(function(){
    var value = $(this).attr('value');
    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=getprofile",
                        data: {
                            'profile_id':value,
                            'user_id':<?php echo $userid; ?>,
                            
                            },
                        dataType: "json",
                        async: false,
                        success: success
            });//eof ajax 
     function success(data) {
        protfolio_name  = data.name;
        comm_rate = data.comission_rate;
     }
 
 vex.dialog.open({
            message: 'Edit Your Portfolio',
            input: "<div class='row'><div class='col-md-12'><div class='equalize'><label>Profile Name:</label></div><input type=\"text\" name=\"portfolio_name\" value='" +protfolio_name+"' /></div><div class='col-md-12'><div class='equalize'><label>Commission Rate:</label></div><input name=\"com\" type=\"text\" id=\"com\" value='"+comm_rate+"'required /> %</div>",
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Change'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Cancel'
                })
            ],
            callback: function (data) {
                if (data === false) {
                    return console.log('Cancelled');
                 } else {
                    //vex.dialog.alert('New Balance Added');
                    //console.log('amount', data.amount);
                    //console.log(oddlot);
                    user_id = <?php echo $userid; ?>;
                    
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=editPortfolio",
                        data: {
                            'user_id': user_id,
                            'portfolio_name' :data.portfolio_name,
                            'com' :data.com,
                            'portfolio_id': value,
                               },
                        dataType: "json",
                        async: false,
                        success: function (data) {
                            console.log(data);
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                        }
                    });
                }
                //console.log('amount', data.amount)
                ;
            }
        });
});//EOF Edit profile
//Delete Profile
$(".deletePortfolio").click(function(){
    var $tr = $(this).closest('tr');
    var value = $(this).attr('value');
    vex.dialog.confirm({ 
        className: 'vex-theme-os', 
        message: 'Are you sure want to delete this profile?',
        buttons: [
                $.extend({}, vex.dialog.buttons.YES, {
                    text: 'Yes'
                }), $.extend({}, vex.dialog.buttons.NO, {
                    text: 'Cancel'
                })
            ], 
        callback: function(data){
                if (data === true) {
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax.php?function=deleteProfile",
                        data: {
                            'user_id': <?php echo $userid; ?>,
                            'portfolio_id': value,
                               },
                        dataType: "json",
                        async: false,
                        success: function (data) {
                           //on success, hide  element user wants to delete.
                       
                        },
                        complete: function () {
                            //vex.dialog.alert ('You Have Successfully Joined This Contest. Best of Luck!!');
                            //location.reload();
                            //on success, hide  element user wants to delete.
                        $tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();
                        })
                        }
                    });
                }
        } 
    });
  
}); //EOF Delete Profile
});
</script>
<?php include("footer.php"); ?>
