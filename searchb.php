
<?php
 
//Including Database configuration file.
 

require_once 'conn_iet.php';

 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
 
//Search query.
 
   $Query = "SELECT name,enroll_no FROM student_table WHERE Name LIKE '%$Name%' OR roll_no LIKE '%$Name%' OR enroll_no LIKE '%$Name%' LIMIT 18";
 
//Query execution
 
   $ExecQuery = MySQLi_query($conn, $Query);
 
//Creating unordered list to display result.
 
   echo '
 
<ul class="list-group list-group-flush">
 
   ';
 
   //Fetching result from database.
 
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
 
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
 
   <li onclick="get_detail('<?php echo $Result['enroll_no']; ?>')" class="list-group-item">
 
   <a href="javascript:void(0);">
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
 
       <?php echo "<b>".$Result['name']."</b>"; ?>
 
   </li>
   </a>
 
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
 
   <?php
 
}}
 
 
?>
 
</ul>