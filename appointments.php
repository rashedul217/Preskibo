<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/dashboard.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

	<?php
    require('db.php');
    require_once 'library.php';
    $rand = get_rand_id(8);
    session_start();

    $username= $_SESSION['username'] ;
    $fullname = $_SESSION['fullname'];
    ?>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>Pres</span>Kibo</p>
  <a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
  <a href="patients.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Patients</a>
  <a href="#"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Appointments</a>
  <a href="medicine.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Medcine Inventory</a>
  <a href="https://meet.google.com/ozd-juwd-dja"class="icon-a"><i class="fa fa-video-camera"></i> &nbsp;&nbsp;Live Meeting</a>
  <a href="account.php"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Account</a>
  <a href="logout.php"class="icon-a"><i class="fa fa-list-alt icons"></i> &nbsp;&nbsp;Sign out</a>

</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Appointments</span>
<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Appointments</span>
</div>
	
	<div class="col-div-6">
	<div class="profile">

		<img src="images/user.svg" class="pro-img" />
		<p><?php echo strtoupper($username)?> <span>Doctor</span></p>
	</div>
</div>
	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>
	
	<div class="col-div-3">
		<div class="box">
			<p>19<br/><span>Patients</span></p>
			<i class="fa fa-users box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>29<br/><span>Appointments</span></p>
			<i class="fa fa-list box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>30<br/><span>Total Medicine</span></p>
			<i class="fa fa-shopping-bag box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>7<br/><span>Total Prescription</span></p>
			<i class="fa fa-tasks box-icon"></i>
		</div>
	</div>
	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-12">
		<div class="box-12">
		<div class="content-box">
			<p>Appointments <span>All</span></p>
			<br/>

			<?php
                        try{
                            $dbcon = new PDO("mysql:host=localhost:3306;dbname=pres_db;","root","");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $query="SELECT * FROM appointments WHERE doctor='$fullname'";
                            
                            try{
                                $sql=$dbcon->query($query);
                                
                                $app_table=$sql->fetchAll();
                                ?>

                      			<table>
                        <tr>
                          <th>Patient Name</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>

                      <?php foreach($app_table as $row){ ?>
                         <tr>
                          <td><?php echo $row['patient_name'] ?></td>
                          <td><?php echo $row['app_date'] ?></td>
                          <td><?php echo $row['app_time'] ?></td>
                          <td>
                            <form method="post" action="process.php">
                                <input name="p_id" type="hidden" value="<?php echo strtoupper($rand); ?>">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Approve" name="approve" class="edit">
                                <input type="submit" value="Reject" name="rejected" class="delete">
                            </form>
                          </td>
                        </tr>
                           <?php
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="5">Data read error ... ...</td>    
                                    </tr>
                                <?php
                            }
                            
                        }
                        catch(PDOException $ex){
                            ?>
                                <tr>
                                    <td colspan="5">Data read error ... ...</td>    
                                </tr>
                            <?php
                        }
                    ?>

                   


  
</table>
		</div>
	</div>
	</div>
		
	<div class="clearfix"></div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(".nav").click(function(){
    $("#mySidenav").css('width','70px');
    $("#main").css('margin-left','70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
     $(".logo span").css('margin-left', '-10px');
     $(".icon-a").css('visibility', 'hidden');
     $(".icons").css('visibility', 'visible');
     $(".icons").css('margin-left', '-8px');
      $(".nav").css('display','none');
      $(".nav2").css('display','block');
  });

$(".nav2").click(function(){
    $("#mySidenav").css('width','300px');
    $("#main").css('margin-left','300px');
    $(".logo").css('visibility', 'visible');
     $(".icon-a").css('visibility', 'visible');
     $(".icons").css('visibility', 'visible');
     $(".nav").css('display','block');
      $(".nav2").css('display','none');
 });

</script>

</body>


</html>
