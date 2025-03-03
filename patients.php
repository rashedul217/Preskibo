<!Doctype HTML>
<html>
<head>
	<title></title>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/dashboard.css" type="text/css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>



	
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>Pres</span>Kibo</p>
  <a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
  <a href="patients.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Patients</a>
  <a href="appointments.php"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Appointments</a>
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
    <?php
    require('db.php');
    session_start();

    $username= $_SESSION['username'] ;
    $fullname = $_SESSION['fullname'];
    ?>

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
			<p>67<br/><span>Patients</span></p>
			<i class="fa fa-users box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>88<br/><span>Appointments</span></p>
			<i class="fa fa-list box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>99<br/><span>Total Medicine</span></p>
			<i class="fa fa-shopping-bag box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>78<br/><span>Total Prescription</span></p>
			<i class="fa fa-tasks box-icon"></i>
		</div>
	</div>
	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-12">
		<div class="box-12">
		<div class="content-box">
			<p>Patients <span>All</span></p>
			<br/>

			<?php
                        try{
                            $dbcon = new PDO("mysql:host=localhost:3306;dbname=pres_db;","root","");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $query="SELECT * FROM patients WHERE doctor_name='$fullname'";
                            
                            try{
                                $sql=$dbcon->query($query);
                                
                                $app_table=$sql->fetchAll();
                                ?>

                      			<table>
                        <tr>
                          <th>Patient ID</th>
                          <th>Patient Name</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Date of Birth</th>
                          <th>Action</th>
                        </tr>

                      <?php foreach($app_table as $row){ ?>
                         <tr>
                          <td><?php echo $row['patient_ID'] ?></td>
                          <td><?php echo $row['fullname'] ?></td>
                          <td><?php echo $row['age'] ?></td>
                          <td><?php echo $row['gender'] ?></td>
                          <td><?php echo $row['dob'] ?></td>
                          <td>
                            <form method="post" action="patient_pres.php">
                                <input type="hidden" name="idp" value="<?php echo $row['patient_ID']; ?>">
                                <button type="submit" name="pres" class="edit">Write Prescription</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
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
