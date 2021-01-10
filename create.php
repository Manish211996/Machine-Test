<?php 
 include('header.php');
 error_reporting(0);
 include 'conn.php';
    $firstName=$lastName=$email=$mobile=$dob=$designation=$gender=$hobbie="";
    $firstNameErr=$lastNameErr=$emailErr=$mobileErr=$dobErr=$designationErr=$genderErr=$hobbieErr="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
      if(!empty($_POST)){
        if($_POST["fristName"]== ""){
          $firstNameErr = "First name is required.";
        }else{
          $firstName = $_POST["fristName"];
        }
        if($_POST["lastName"]== ""){
          $lastNameErr = "Last name is required.";
        }else{
          $lastName = $_POST["lastName"];
        }
        if($_POST["email"]== ""){
          $emailErr = "Email is required.";
        }else{
          $email = $_POST["email"];
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
          }
        }
        if($_POST["dob"]== ""){
          $dobErr = "Date Of birth is required.";
        }else{
          $dob = $_POST["dob"];
        }
        if($_POST["mobile"]== ""){
          $mobileErr = "Mobile number is required.";
        }else{
          $mobile = $_POST["mobile"];
          if(!preg_match('/^[0-9]{10}+$/', $mobile)){
            $mobileErr = "Must be number and maximum 10 digit of length.";
          }          
        }
        if($_POST["designation"]== ""){
          $designationErr = "Designation is required.";
        }else{
          $designation = $_POST["designation"];
        }
        if($_POST["gender"]== ""){
          $genderErr = "Gender is required.";
        }else{
          $gender = $_POST["gender"];
        }
        if($_POST["hobbies"]== ""){
          $hobbieErr = "Hobbies is/are required.";
        }else{
          $hobbie = implode(", ",$_POST["hobbies"]);
        }
      }
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && ($firstNameErr=="" && $lastNameErr=="" && $emailErr =="" && $mobileErr=="" && $designationErr=="" && $dobErr=="" && $genderErr=="" && $hobbieErr=="" && $designationErr=="")){
      $q ="INSERT INTO  `user` ( `firstName` ,  `lastName` ,  `email`,  `dob`,  `telephone`,  `Designation`,  `gender`,  `hobbies` ) VALUES ('$firstName',  '$lastName',  '$email', '$dob','$mobile','$designation','$gender','$hobbie')";
      $query = mysqli_query($conn,$q)or die("check querry");
      $firstName=$lastName=$email=$mobile=$dob=$designation=$gender=$hobbie="";
      header('location:excehome.php');
    }
    mysqli_close($conn);
?>
  <div class="form-popup" id="myForm">
    <form id="myform" method="post" class="form-container">
      <h1>Create New Data</h1>
      <label for="fristName"><b>First name</b></label>
      <input type="text" placeholder="Enter first name" name="fristName" value="<?php if(isset($firstName)){echo $firstName;}?>" required>
      <span id="error" style="color: red"><?php echo $firstNameErr;?></span>
      <label for="lastName"><b>Last name</b></label>
      <input type="text" placeholder="Enter last name" name="lastName" value="<?= $lastName?>" required>
      <span id="error" style="color: red"><?php echo $lastNameErr;?></span>
      <label for="Email"><b>Email</b></label>
      <input type="email" placeholder="Enter email" name="email" value="<?= $email?>" required>
      <span id="error" style="color: red"><?php echo $emailErr;?></span>
      <label for="dob"><b>Date Of Birth</b></label>
      <input type="date" placeholder="Enter date of birth" name="dob" value="<?= $dob?>" required>
      <span id="error" style="color: red"><?php echo $dobErr;?></span>
      <label for="mobile"><b>Mobile</b></label>
      <input type="number" placeholder="Enter mobile number" name="mobile" value="<?= $mobile?>" required>
      <span id="error" style="color: red"><?php echo $mobileErr;?></span>
      <label for="designation"><b>Designation</b></label>
      <input type="text" placeholder="Enter designation" name="designation" value="<?= $designation?>" required>
      <span id="error" style="color: red"><?php echo $designationErr;?></span>
      <label for="fristName"><b>Gender</b></label><br>
      <input type="radio" id="male" name="gender" <?php if($gender=="male"){echo "checked";}?> value="male" require>
      <label for="male">Male</label><br>
      <input type="radio" id="female" name="gender" <?php if($gender=="female"){echo "checked";}?> value="female">
      <label for="female">Female</label><br>
      <input type="radio" id="other" name="gender" <?php if($gender=="other"){echo "checked";}?> value="other">
      <label for="other">Other</label><br><br>
      <span id="error" style="color: red"><?php echo $genderErr;?></span><br>
      <label for="hobbies"><b>Hobbies</b></label><br>
      <input type="checkbox" id="hobbies1" name="hobbies[]" value="volleyball">
        <label for="hobbies"> Volleyball</label><br>
        <input type="checkbox" id="hobbies2" name="hobbies[]" value="music">
        <label for="hobbies"> Music</label><br>
        <input type="checkbox" id="hobbies3" name="hobbies[]" value="singing">
        <label for="hobbies"> Singing</label><br>
        <input type="checkbox" id="hobbies4" name="hobbies[]" value="coading">
        <label for="hobbies"> Coading</label>
      <span id="error" style="color: red"><?php echo $hobbieErr;?></span>
      <button type="submit" name="add" value="submit" class="btn">Submit</button>
      <a href="excehome.php" ><button type="button" class="btn cancel">Back</button></a>
    </form>
  </div>
</body>
</html>