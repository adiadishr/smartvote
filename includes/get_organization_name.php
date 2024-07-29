<?php
// Get organization name
$sql = "SELECT * FROM organizations WHERE id = $organization_id";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$organization = $row['organization'];
