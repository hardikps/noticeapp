<?php
require('connection.php');
extract($_POST);
if(isset($save))
{
//check user alereay exists or not
$sql=mysqli_query($conn,"select * from user where email='$email'");
$sql2=mysqli_query($conn,"select * from user where Villagers_ID='$stuid'");
$sql3=mysqli_query($conn,"select * from user where mobile='$mob'");

$r=mysqli_num_rows($sql);
$r2=mysqli_num_rows($sql2);
$r3=mysqli_num_rows($sql3);

if($r==true)
{
$err= "<font color='red'>This E-mail already exists</font>";
}
else if($r2==true)
{
$err= "<font color='red'>This Villagers ID already exists</font>";	
}
else if($r3==true)
{
$err= "<font color='red'>This E-mail Mobile number slready exists</font>";	
}
else
{
//dob
$dob=$yy."-".$mm."-".$dd;

//hobbies
$hob=implode(",",$hob);

//image
$imageName=$_FILES['img']['name'];


//encrypt your password
$pass=md5($pass);
$utyp='Villagers';

$query="insert into user values('','$uname','$email','$pass','$mob','$gen','$hob','$imageName','$dob','$stuid','$utyp','')";
mysqli_query($conn,$query);

//upload image

mkdir("images/$email");
move_uploaded_file($_FILES['img']['tmp_name'],"images/$email/".$_FILES['img']['name']);


$err="<font color='blue'>Registration successfull !!</font>";

}
}
?>


<h2><b>REGISTRATION FORM</b></h2>
<span style="color:red;font-size:16px;">
N.B.: This registration form is only for Villagers.If you are a Admin or Faculty then please contact with admin for your account.
</span>
<div class="pt">
		<form method="post" enctype="multipart/form-data">
			<table class="table table-bordered">
	<Tr>
		<Td colspan="2"><?php echo @$err;?></Td>
	</Tr>
				<tr>
					<td>User Type</td>
					<Td><input  type="text" value="1" class="form-control"required disabled /></td>
				</tr>
				<tr>
					<td>Villagers ID</td>
					<Td><input  type="text" placeholder="Villagers ID" class="form-control" name="stuid" required /></td>
				</tr>
				<tr>
					<td>Your Name</td>
					<Td><input  type="text" placeholder="Villagers Name" class="form-control" name="uname" required /></td>
				</tr>
				<tr>
					<td>Your Email </td>
					<Td><input type="email"  class="form-control" placeholder="Villagers E-mail" name="email" required /></td>
				</tr>

				<tr>
					<td>Your Password </td>
					<Td><input type="password"  class="form-control" placeholder="Password" name="pass" required /></td>
				</tr>

				<tr>
					<td>Your Mobile No. </td>
					<Td><input  class="form-control" type="text" placeholder="Villagers phone number" name="mob" required /></td>
				</tr>

				<tr>
					<td>Select Your Gender</td>
					<Td>
				<input type="radio" name="gen" value="m" required/>  Male <br/>
				<input type="radio" name="gen" value="f"/>  Female 
					</td>
				</tr>

				<tr>
					<td>Choose Your Hobbies</td>
					<Td>
					<input value="reading" type="checkbox" name="hob[]"/>  Reading <br/>
					<input value="singin" type="checkbox" name="hob[]"/>   Singing <br/>
					<input value="playing" type="checkbox" name="hob[]"/>  Playing <br/>
					<input value="Dancing" type="checkbox" name="hob[]"/>  Dancing <br/>
					<input value="others" type="checkbox" name="hob[]"/>  Others
					
					</td>
				</tr>


				<tr>
					<td>Upload  Your Image </td>
					<Td><input class="form-control" type="file" name="img" required /></td><br/>
				</tr>

				<tr>
					<td>Date of Birth</td>
					<Td>
					<select name="yy" required>
					<option value="">Year</option>
					<?php
					for($i=1950;$i<=2021;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>

					<select name="mm" required>
					<option value="">Month</option>
					<?php
					for($i=1;$i<=12;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>


					<select name="dd" required>
					<option value="">Date</option>
					<?php
					for($i=1;$i<=31;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>

					</td>
				</tr>

				<tr>


<Td colspan="2" align="center">
<input type="submit" class="btn btn-success" value="Save" name="save"/>
<input type="reset" class="btn btn-success" value="Reset"/>

					</td>
				</tr>
			</table>
		</form>
		</div>
	</body>
</html>
