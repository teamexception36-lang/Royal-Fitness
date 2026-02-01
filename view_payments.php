// In admin_dashboard.php, you can add a query like this:
$active_members = mysqli_query($conn, "SELECT username, email, active_plan FROM users WHERE active_plan != 'No Active Plan'");

// In the UI, display it in a table:
while($row = mysqli_fetch_assoc($active_members)) {
    echo "<tr>
            <td>".$row['username']."</td>
            <td>".$row['active_plan']."</td>
          </tr>";
}