<html lang="en">
    <head>
    <meta http-equiv="refresh" content="2" /> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <title>ZK Test</title>
    </head>
    
    <body>
<?php
    require __DIR__ . '/../../vendor/autoload.php';
    use Mike42\Escpos\Printer;
    
    include("zklib/zklib.php");

    
    use Mike42\Escpos\PrintConnectors\FilePrintConnector;
    use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
    
    $zk = new ZKLib("192.168.68.114", 4370);
    
    $ret = $zk->connect();

    // sleep(1);
    // if ( $ret ): 
    //     $zk->disableDevice();
    //     sleep(1);
    ?>
        
        <table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <td><b>Status</b></td>
                <td>Connected</td>
                <td><b>Version</b></td>
                <td><?php echo $zk->version() ?></td>
                <td><b>OS Version</b></td>
                <td><?php echo $zk->osversion() ?></td>
                <td><b>Platform</b></td>
                <td><?php echo $zk->platform() ?></td>
            </tr>
            <tr>
                <td><b>Firmware Version</b></td>
                <td><?php echo $zk->fmVersion() ?></td>
                <td><b>WorkCode</b></td>
                <td><?php echo $zk->workCode() ?></td>
                <td><b>SSR</b></td>
                <td><?php echo $zk->ssr() ?></td>
                <td><b>Pin Width</b></td>
                <td><?php echo $zk->pinWidth() ?></td>
            </tr>
            <tr>
                <td><b>Face Function On</b></td>
                <td><?php echo $zk->faceFunctionOn() ?></td>
                <td><b>Serial Number</b></td>
                <td><?php echo $zk->serialNumber() ?></td>
                <td><b>Device Name</b></td>
                <td><?php echo $zk->deviceName(); ?></td>
                <td><b>Get Time</b></td>
                <td><?php echo $zk->getTime() ?></td>
            </tr>
        </table>
        <hr />
        <table border="1" cellpadding="5" cellspacing="2" style="float: left; margin-right: 10px;">
            <tr>
                <th colspan="5">Data User</th>
            </tr>
            <tr>
                <th>UID</th>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Password</th>
            </tr>

            <?php
            try {
                
                //$zk->setUser(1, '1', 'Admin', '', LEVEL_ADMIN);
                $user = $zk->getUser();

                $size = count($user);
                $last_user_ref_id = $user[$size][0];
                $name = $user[$size][1];
                $password = $user[$size][3];

                echo $last_user_ref_id;
                echo $name;
                echo $password;
                // var_dump($size);

                $connection = mysqli_connect("localhost","root","","project");

                $user_search_query = "SELECT * FROM users WHERE user_ref_id = $last_user_ref_id ";

                $result = mysqli_query($connection, $user_search_query);

                if (mysqli_num_rows ($result) == 0) {
                    
                    echo "NAI";

                    $query = "INSERT INTO users( name, password, user_ref_id )";
                    $query .= "VALUES ('{$name}', '{$password}', '{$last_user_ref_id}' )";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                }
                
                ?>

                <?php

            } catch (Exception $e) {
                header("HTTP/1.0 404 Not Found");
                header('HTTP', true, 500); // 500 internal server error                
            }
            //$zk->clearAdmin();
            ?>
        </table>
        
        <table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <th colspan="6">Data Attendance</th>
            </tr>
            <tr>
                <th>Index</th>
                <th>UID</th>
                <th>ID</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            $attendance = $zk->getAttendance();

            $size = count($attendance)-1;
            $token = $attendance[$size][0];
            $last_user_id = $attendance[$size][1];
            $user_date =  $attendance[$size][3];
            $user_time = $attendance[$size][3];
            $user_last_date = date( "Y-m-d", strtotime( $user_date));
            $user_last_time = date( "H:i:s", strtotime( $user_date));

            // echo $last_user_id;
            // echo $user_last_date;
            // echo $user_last_time;
            
            $connection = mysqli_connect("localhost","root","","project");

            $attendance_search_query = "SELECT * FROM attendances WHERE user_id = $last_user_id AND date = '$user_last_date' ";

            $result = mysqli_query($connection, $attendance_search_query);

            if (mysqli_num_rows ($result) ==0) {

               

                $name_query = "SELECT * FROM users WHERE user_ref_id = $last_user_id ";

                
                $name_result = mysqli_query($connection, $name_query);
                while($row = mysqli_fetch_assoc($name_result))
                {
                    $user_name = $row['name'];
                    $user_department = $row['department'];
                    $user_designation = $row['designation'];
                    
                  echo $user_name;
                  echo $user_department;
                
                 echo "nai kichu";

                try {
                    // Enter the share for your USB printer here
                    // $connector = null;
                    $connector = new WindowsPrintConnector("pos");
                
                    /* Print a "Hello world" receipt" */
                    $printer = new Printer($connector);
                
                 
                    $printer->text("GLOBE GROUP LTD.");



                    $printer->text("\nTOKEN NO: ". $token);
                    $printer -> text("\nDATE: ". $user_last_date);
                    $printer -> text("\nTIME: ". $user_last_time);
                    $printer->text("\nUSER ID: ". $last_user_id);
                    $printer->text("\nUSER NAME: ". $user_name);
                    $printer->text("\nUSER DEPARTMENT: ". $user_department);
                    $printer->text("\nUSER DESIGNATION: ". $user_designation);
                    $printer->text("\nTHANK YOU");
                    
                    




                    $printer -> cut();
                    
                    /* Close printer */
                    $printer -> close();
                } catch (Exception $e) {
                    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
                }


            }

            


                    $connection = mysqli_connect("localhost","root","","project");

                    $sql = "INSERT INTO attendances(user_ref_id, token_status, date, time )";
                    $sql .= "VALUES ('{$last_user_id}', 'taken', '{$user_last_date}', '{$user_last_time}' )";
                    $result = mysqli_query($connection, $sql);
                    if(!$result){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                        // echo "nai";
                }
                else{
                    echo "ache";
                }
            
            
            sleep(1);
            while(list($idx, $attendancedata) = each($attendance)):
                if ( $attendancedata[2] == 14 )
                    $status = 'Check Out';
                else
                    $status = 'Check In';
            ?>
            <tr>
                <?php 
                $date = date( "Y-m-d", strtotime( $attendancedata[3]));
                    
                ?>
                <td><?php echo $idx ?></td>
                <td><?php echo $attendancedata[0] ?></td>
                <td><?php echo $attendancedata[1] ?></td>
                <td><?php echo $status ?></td>
                <td><?php echo date( "d-m-Y", strtotime( $attendancedata[3] ) ) ?></td>
                <td><?php echo date( "H:i:s", strtotime( $attendancedata[3] ) ) ?></td>

                <?php
                //     $inde_x = $idx;
                //     $UID = $attendancedata[0];
                //     $ref_ID = $attendancedata[1];
                //     $date = date( "Y-m-d", strtotime( $attendancedata[3]));
                //     $time = date( "H:i:s", strtotime( $attendancedata[3]));

                //     $connection = mysqli_connect("localhost","root","","project");
                
                // //$last = $attendance[count($attendance)];
                

                // $sql = "INSERT INTO attendances(user_id, user_ref_id, status, date, time)";
                // $sql .= "VALUES ('{$ref_ID}', '{$ref_ID}', '{$status}', '{$date}', '{$time}' )";
                // $result = mysqli_query($connection, $sql);
                // if(!$result){
                //     die("QUERY FAILED" . mysqli_error($connection));
                // }
                ?>

            </tr>
            <?php
            endwhile
            ?>
        </table>
        
        <fieldset>
            <legend><b>Example Using: </b></legend>
            
<pre style='color:#000000;background:#ffffff;'><pre>
<span style='color:#5f5035;'>&lt;?php</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>include</span><span style='color:#808030;'>(</span><span style='color:#0000e6;'>"zklib/zklib.php"</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#800000;font-weight:bold; '>new</span><span> ZKLib</span><span style='color:#808030;'>(</span><span style='color:#0000e6;'>"192.168.1.201"</span><span style='color:#808030;'>,</span><span> </span><span style='color:#008c00;'>4370</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$ret</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>connect</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>disableDevice</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>version</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>osversion</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>platform</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>fmVersion</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>workCode</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>ssr</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>pinWidth</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>faceFunctionOn</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>serialNumber</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>deviceName</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$user</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>getUser</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>while</span><span style='color:#808030;'>(</span><span> </span><span style='color:#800000;font-weight:bold; '>list</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$uid</span><span style='color:#808030;'>,</span><span> </span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>)</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#400000;'>each</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$user</span><span style='color:#808030;'>)</span><span> </span><span style='color:#808030;'>)</span><span> </span><span style='color:#800080;'>{</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>if</span><span> </span><span style='color:#808030;'>(</span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>2</span><span style='color:#808030;'>]</span><span> </span><span style='color:#808030;'>=</span><span style='color:#808030;'>=</span><span> LEVEL_ADMIN</span><span style='color:#808030;'>)</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$role</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#0000e6;'>'ADMIN'</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>elseif</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>2</span><span style='color:#808030;'>]</span><span> </span><span style='color:#808030;'>=</span><span style='color:#808030;'>=</span><span> LEVEL_USER</span><span style='color:#808030;'>)</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$role</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#0000e6;'>'USER'</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>else</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$role</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#0000e6;'>'Unknown'</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'UID: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$uid</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'ID: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>0</span><span style='color:#808030;'>]</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Name: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>1</span><span style='color:#808030;'>]</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Role: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$role</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Password: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$userdata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>3</span><span style='color:#808030;'>]</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800080;'>}</span><span></span>
<span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$attendance</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>getAttendance</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>while</span><span style='color:#808030;'>(</span><span> </span><span style='color:#800000;font-weight:bold; '>list</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$idx</span><span style='color:#808030;'>,</span><span> </span><span style='color:#797997;'>$attendancedata</span><span style='color:#808030;'>)</span><span> </span><span style='color:#808030;'>=</span><span> </span><span style='color:#400000;'>each</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$attendance</span><span style='color:#808030;'>)</span><span> </span><span style='color:#808030;'>)</span><span> </span><span style='color:#800080;'>{</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Index: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$idx</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'ID: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$attendancedata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>0</span><span style='color:#808030;'>]</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Status: '</span><span style='color:#808030;'>.</span><span style='color:#797997;'>$attendancedata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>1</span><span style='color:#808030;'>]</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Date: '</span><span style='color:#808030;'>.</span><span style='color:#400000;'>date</span><span style='color:#808030;'>(</span><span style='color:#0000e6;'>"d-m-Y"</span><span style='color:#808030;'>,</span><span> </span><span style='color:#400000;'>strtotime</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$attendancedata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>2</span><span style='color:#808030;'>]</span><span style='color:#808030;'>)</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800000;font-weight:bold; '>echo</span><span> </span><span style='color:#0000e6;'>'Time: '</span><span style='color:#808030;'>.</span><span style='color:#400000;'>date</span><span style='color:#808030;'>(</span><span style='color:#0000e6;'>"H:i:s"</span><span style='color:#808030;'>,</span><span> </span><span style='color:#400000;'>strtotime</span><span style='color:#808030;'>(</span><span style='color:#797997;'>$attendancedata</span><span style='color:#808030;'>[</span><span style='color:#008c00;'>2</span><span style='color:#808030;'>]</span><span style='color:#808030;'>)</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#800080;'>}</span><span></span>
<span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>getTime</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>enableDevice</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style='color:#797997;'>$zk</span><span style='color:#808030;'>-</span><span style='color:#808030;'>></span><span>disconnect</span><span style='color:#808030;'>(</span><span style='color:#808030;'>)</span><span style='color:#800080;'>;</span><span></span>
<span style='color:#5f5035;'>?></span>
</pre>
        
        </fieldset>
    <?php
       // $zk->enrollUser('123');
       // $zk->setUser(123, '123', 'Shubhamoy Chakrabarty', '', LEVEL_USER);
        //$zk->enableDevice();
        //sleep(1);
     ///   $zk->disconnect();
    //endif
?>
    </body>
</html>
