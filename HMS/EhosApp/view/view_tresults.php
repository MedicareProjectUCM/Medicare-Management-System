
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Test Results
        </title>
    </head>
    <body>
        <h2> Test Results </h2>
        <table border=1 >
            <thead> 
                <tr>
                    <th bgcolor='pink'>S. No.</th>
                    <th bgcolor='pink'>Complaint ID</th>
                    <th bgcolor='pink'>Doctor ID</th>
                    <th bgcolor='pink'>Patient ID</th>
                    <th bgcolor='pink'>Complaint Date </th>
                    <th bgcolor='pink'>Prescribed Medicines </th>
                    <th bgcolor='pink'>Suggested Tests </th>
                    <th bgcolor='pink'>Test Date </th>
                    <th bgcolor='pink'>Test Result File </th>
                </tr> 
            </thead>
            <tbody>

                <?php
                require('/model/appvars.php');
                require('/model/db_connect.php');
                require('/model/patient_repository.php');
                require('/model/doctor_repository.php');
                require('/model/user_repository.php');
                require('/model/complaint_repository.php');
                require('/model/tresults_repository.php');
                require('/model/mcare_repository.php');

                $patient = is_patient($_SESSION['user_name']);
                $doctor = is_doctor($_SESSION['user_name']);
                if ($patient['pid'] != NULL) {
                    $tresuits = get_tresults($_SESSION['user_id']);
                    $events = get_complaints($_SESSION['user_id']);
                } 
                elseif ($doctor['did'] != NULL)
                {
                    $events = get_complaints_doctor($_SESSION['user_id']);
                    $tresuits = get_tresults_doctor($_SESSION['user_id']);
                }
                else 
                {
                    $mid= get_medicareID($_SESSION['user_name']);
                    $events = get_comp_mcare($mid);
                    $tresuits = get_tresults_mcare($mid);
                }
                $i = 0;
                for ($index = 0; $index < count($events); $index++) {

                    echo '<tr>';
                    echo "<td bgcolor='yellow'>" . ( ++$i) . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['cid'] . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['did'] . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['pid'] . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['cdate'] . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['medicines'] . '</td>';
                    echo "<td bgcolor='yellow'>" . $events[$index]['tests'] . '</td>';
                    $firstTdData = "";
                    $secondTdData = "";
                    if ($tresuits != NULL && isset($tresuits[$index])) {
                        $firstTdData =  $tresuits[$index]['tdate'] ;
                        $secondTdData = $tresuits[$index]['tfilepath'] ;
                    }
                    echo "<td bgcolor='yellow'>" . $firstTdData . '</td>';
                    echo "<td bgcolor='yellow'><a href='files/" .  $secondTdData . "'>" .  $secondTdData . '</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($patient['pid'] != NULL)
            echo '<a href="patient_home.php" > Back </a>';
        else
            echo '<a href="doctor_home.php" > Back </a>';
        ?>
    </body>
</html>
