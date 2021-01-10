<?php
  	include_once('header.php');
	include_once('conn.php');
	error_reporting(0);
	$start=0;
	$limit=5;
	$sort ='ASC';
	$field= isset($_GET['field']) ? $_GET['field'] :"id";
	if(isset($_GET['sort']))
	{
		if($_GET['sort']=='ASC')
		{
			$sort='DESC';
		}
		else
		{
			$sort='ASC';
		}
	}
		if($_GET['id']) {
			$id=$_GET['id'];
			$start=($id-1)*($limit);
		}
		else {
			$id=1;
		}	
		$search = "";
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
		}
		$sql= "select * from user  " ;
		if(!empty($search))  {
			$search=strtolower($search);
			$sql="select id, firstName, lastName, email, dob, telephone, Designation, gender, hobbies from user where firstName like '%$search%' or Designation like '%$search%' or email like '%$search%' or telephone like '%$search%'  ESCAPE '@'"; 
		}
		$result=mysqli_query($conn,$sql);
		$total_row=mysqli_num_rows($result); echo "<br>";
		$no_page= ceil($total_row/$limit);
		$urlparam= "";
		if(!empty($search)){
			$urlparam = "&search=".$search;
		}
		
?>
			<script type="text/javascript">
				function form_post() {
					var search = document.getElementById("searchtxt").value;
					if(search !== undefined && search.length >0) {
						window.location.href = "excehome.php?search="+search;
					}	
				}
			</script>
			<div class="div1 div2">
				<form method="get" action="excehome.php">
					<input type="text" name="search" id="searchtxt" placeholder="Search..." value="<?php echo $search;?>" required>
					<input type="submit" name="Search" value="search" onclick="form_post(); return false;">
					
				</form>
				<a href="excehome.php" ><button class="butnReset" >RESET</button></a><br><br>
			</div>
			<span>Total No. of records are : <?= $total_row ?></span>
			<div>   
				<table id="t01">
					<tr>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=id".$urlparam; ?>">ID</a></th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=firstName".$urlparam; ?>">First Name</a></th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=lastName".$urlparam; ?>">Last Name</a></th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=email".$urlparam; ?>">Email</th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=dob".$urlparam; ?>">DOB</th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=telephone".$urlparam; ?>">Mobile</th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=Designation".$urlparam; ?>">Designation</th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=gender".$urlparam; ?>">Gender</th>
						<th><a href="?id=<?php echo $id."&sort=".$sort."&pageid=".$id."&field=hobbies".$urlparam; ?>">Hobbies</th>
						
					</tr>
				<?php
				   $sql= "select * from user  order by $field $sort limit  $start , $limit" ;echo "<br>";
					if(!empty($search)){
						$search=strtolower($search);
						$sql="select id, firstName, lastName, email, dob, telephone, Designation, gender, hobbies from user where firstName like '%$search%' or Designation like '%$search%' or email like '%$search%' or telephone like '%$search%' ESCAPE '@' order by $field $sort limit $start , $limit"; 
          			}	
					if($sort=='ASC')
					{
						$sort='DESC';
					}
					else
					{
						$sort='ASC';
					}
					$query = mysqli_query($conn,$sql) or die("query is wrong please go through it.");
					$total_show=mysqli_num_rows($query);
					while($res=mysqli_fetch_array($query)){
				?>
					<tr>
						<td><?php echo $res['id']; ?></td>
						<td><?php echo $res['firstName']; ?></td>
						<td><?php echo $res['lastName']; ?></td>
						<td><?php echo $res['email']; ?></td>
						<td><?php echo $res['dob']; ?></td>
						<td><?php echo $res['telephone']; ?></td>
						<td><?php echo $res['Designation']; ?></td>
						<td><?php echo $res['gender']; ?></td>
						<td><?php echo $res['hobbies']; ?></td>
					</tr>
				<?php
					}
				?>
			</table>	
			<?php
				echo '<ul class="sec2">';
				if($id>1){
					echo '<ul><li><a href="?id='.($id-1)."&sort=".$sort."&pageid=".$id."&field=".$field.$urlparam.'">Previous</a></li>';
					}
				 for($i = $id ; $i <= min($id +2, $no_page); $i++) {
					echo '<li><a href="?id='.$i."&sort=".$sort."&pageid=".$id."&field=".$field.$urlparam.'">'.$i.'</a></li>';
				}
				if($no_page>1 && $total_show>=5){
					echo '<li><a href="?id='.($id+1)."&sort=".$sort."&pageid=".$id."&field=".$field.$urlparam.'">Next</a></li> ';
					}
					echo '</ul>';
				mysqli_close($conn); 
			?>
			</div>
		</body>
	</html>

