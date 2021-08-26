<?php 
	include('../../Elements/header.php');
    session_start();

?>

<section class="admin-panel-section">
    <div class="admin-panel-sidebar">
        <div class="admin-sidebar-content">
            <div class="admin-side-it"><a href="/Admin/admin-index.php">หน้าหลัก</a></div>
            <div class="admin-side-it"><a href="/Admin/edit/edit-menu.php">แก้ไขแบบประเมินใบฟ้า</a></div>
            <div class="admin-side-it"><a href="/Admin/data/data-menu.php">export ข้อมูล</a></div>
            <div class="admin-side-it"><a href="/Admin/org/org-menu.php">สำหรับองค์กร</a></div>
        </div>
    </div>
    <div class="admin-side-content">
        <div class="container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ประวัติ</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ข้อมูล</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <button onclick="exportTableToCSV('user.csv')" class="bt-export">Export HTML Table To CSV File</button>
                <?php
                    $con=mysqli_connect("localhost","raip5721","Iwanttobefree55","Fraip57210");
                    mysqli_set_charset($con, "utf8");
                    // Check connection
                    if (mysqli_connect_errno())
                    {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    

                    $result = mysqli_query($con,"SELECT * 
                    FROM frp_user INNER JOIN frp_personal_info ON frp_user.user_id = frp_personal_info.user_id 
                    ORDER BY frp_user.user_id asc LIMIT 20");

                    echo "<table border='1' class='user'>
                    <tr>
                        <th>id</th>
                        <th>ชื่อ</th>
                        <th>email</th>
                        <th>regist_date</th>
                        <th>verified</th>
                        <th>sex</th>
                        <th>age</th>
                        <th>weight</th>
                        <th>height</th>
                        <th>medical_cond</th>
                        <th>waist</th>
                        <th>sbp</th>
                        <th>dbp</th>
                        <th>province</th>
                        <th>date_submit</th>
                    </tr>";

                    while($row = mysqli_fetch_array($result))
                    {
                    echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['regist_date'] . "</td>";
                        echo "<td>" . $row['verified'] . "</td>";
                        echo "<td>" . $row['sex'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['weight'] . "</td>";
                        echo "<td>" . $row['height'] . "</td>";
                        echo "<td>" . str_replace(',', ';', $row['medical_cond']) . "</td>";
                        echo "<td>" . $row['waist'] . "</td>";
                        echo "<td>" . $row['sbp'] . "</td>";
                        echo "<td>" . $row['dbp'] . "</td>";
                        echo "<td>" . $row['province'] . "</td>";
                        echo "<td>" . $row['date_submit'] . "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                    //----------------------------------noshow--------------------------------------

                    $result_no = mysqli_query($con,"SELECT * 
                    FROM frp_user INNER JOIN frp_personal_info ON frp_user.user_id = frp_personal_info.user_id 
                    ORDER BY frp_user.user_id asc");
                    echo "<table border='1' class='user dont'>
                    <tr>
                        <th>id</th>
                        <th>ชื่อ</th>
                        <th>email</th>
                        <th>regist_date</th>
                        <th>verified</th>
                        <th>sex</th>
                        <th>age</th>
                        <th>weight</th>
                        <th>height</th>
                        <th>medical_cond</th>
                        <th>waist</th>
                        <th>sbp</th>
                        <th>dbp</th>
                        <th>province</th>
                        <th>date_submit</th>
                    </tr>";

                    while($row = mysqli_fetch_array($result_no))
                    {
                    echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['regist_date'] . "</td>";
                        echo "<td>" . $row['verified'] . "</td>";
                        echo "<td>" . $row['sex'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['weight'] . "</td>";
                        echo "<td>" . $row['height'] . "</td>";
                        echo "<td>" . str_replace(',', ';', $row['medical_cond']) . "</td>";
                        echo "<td>" . $row['waist'] . "</td>";
                        echo "<td>" . $row['sbp'] . "</td>";
                        echo "<td>" . $row['dbp'] . "</td>";
                        echo "<td>" . $row['province'] . "</td>";
                        echo "<td>" . $row['date_submit'] . "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";

                    mysqli_close($con);
                ?>
                

                <script>
                    function downloadCSV(csv, filename) {
                        var csvFile;
                        var downloadLink;

                        // CSV file
                        csvFile = new Blob([csv], {type: "text/csv"});

                        // Download link
                        downloadLink = document.createElement("a");

                        // File name
                        downloadLink.download = filename;

                        // Create a link to the file
                        downloadLink.href = window.URL.createObjectURL(csvFile);

                        // Hide download link
                        downloadLink.style.display = "none";

                        // Add the link to DOM
                        document.body.appendChild(downloadLink);

                        // Click download link
                        downloadLink.click();
                    }

                    function exportTableToCSV(filename) {
                        var csv = [];
                        var rows = document.querySelectorAll("table.user.dont tr");
                        
                        for (var i = 0; i < rows.length; i++) {
                            var row = [], cols = rows[i].querySelectorAll("td, th");
                            
                            for (var j = 0; j < cols.length; j++) 
                                row.push(cols[j].innerText);
                            
                            csv.push(row.join(","));        
                        }

                        // Download CSV file
                        downloadCSV(csv.join("\n"), filename);
                    }

                </script>
                </div>
<!-- //-----------------------------------------------------------------tab2----------------------------------------------------------------------------------------------- -->


                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <button onclick="exportTableToCSV2('lastdate.csv')" class="bt-export">Export HTML Table To CSV File</button>
                    <?php
                        $con2=mysqli_connect("localhost","raip5721","Iwanttobefree55","Fraip57210");
                        mysqli_set_charset($con2, "utf8");
                        // Check connection
                        if (mysqli_connect_errno())
                        {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        

                        $result2 = mysqli_query($con2,"SELECT * FROM frp_health_result_personal  ORDER BY date_submit DESC LIMIT 20");

                        echo "<table border='1' class='table_personal'>
                        <tr>
                            <th>entry_id</th>
                            <th>user_id</th>
                            <th>2_lwater</th>
                            <th>sugar_drink</th>
                            <th>veggie</th>
                            <th>fruit1unit</th>
                            <th>fried_food</th>
                            <th>10000walk</th>
                            <th>cardio_ex</th>
                            <th>weight_ex</th>
                            <th>stretch_muscle</th>
                            <th>sum</th>
                            <th>percent_sum</th>
                            <th>date_submit</th>
                        </tr>";

                        while($row = mysqli_fetch_array($result2))
                        {
                        echo "<tr>";
                            echo "<td>" . $row['entry_id'] . "</td>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['2_lwater'] . "</td>";
                            echo "<td>" . $row['sugar_drink'] . "</td>";
                            echo "<td>" . $row['veggie'] . "</td>";
                            echo "<td>" . $row['fruit1unit'] . "</td>";
                            echo "<td>" . $row['fried_food'] . "</td>";
                            echo "<td>" . $row['10000walk'] . "</td>";
                            echo "<td>" . $row['cardio_ex'] . "</td>";
                            echo "<td>" . $row['weight_ex'] . "</td>";
                            echo "<td>" . $row['stretch_muscle'] . "</td>";
                            echo "<td>" . $row['sum'] . "</td>";
                            echo "<td>" . $row['percent_sum'] . "</td>";
                            echo "<td>" . $row['date_submit'] . "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";
                        //----------------------------------------------no

                        $result2_no = mysqli_query($con2,"SELECT * FROM frp_health_result_personal  ORDER BY date_submit DESC");

                        echo "<table border='1' class='table_personal dont'>
                        <tr>
                            <th>entry_id</th>
                            <th>user_id</th>
                            <th>2_lwater</th>
                            <th>sugar_drink</th>
                            <th>veggie</th>
                            <th>fruit1unit</th>
                            <th>fried_food</th>
                            <th>10000walk</th>
                            <th>cardio_ex</th>
                            <th>weight_ex</th>
                            <th>stretch_muscle</th>
                            <th>sum</th>
                            <th>percent_sum</th>
                            <th>date_submit</th>
                        </tr>";

                        while($row = mysqli_fetch_array($result2_no))
                        {
                        echo "<tr>";
                            echo "<td>" . $row['entry_id'] . "</td>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['2_lwater'] . "</td>";
                            echo "<td>" . $row['sugar_drink'] . "</td>";
                            echo "<td>" . $row['veggie'] . "</td>";
                            echo "<td>" . $row['fruit1unit'] . "</td>";
                            echo "<td>" . $row['fried_food'] . "</td>";
                            echo "<td>" . $row['10000walk'] . "</td>";
                            echo "<td>" . $row['cardio_ex'] . "</td>";
                            echo "<td>" . $row['weight_ex'] . "</td>";
                            echo "<td>" . $row['stretch_muscle'] . "</td>";
                            echo "<td>" . $row['sum'] . "</td>";
                            echo "<td>" . $row['percent_sum'] . "</td>";
                            echo "<td>" . $row['date_submit'] . "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";

                        mysqli_close($con);
                    ?>
                    

                    <script>
                        function downloadCSV2(csv, filename) {
                            var csvFile;
                            var downloadLink;

                            // CSV file
                            csvFile = new Blob([csv], {type: "text/csv"});

                            // Download link
                            downloadLink = document.createElement("a");

                            // File name
                            downloadLink.download = filename;

                            // Create a link to the file
                            downloadLink.href = window.URL.createObjectURL(csvFile);

                            // Hide download link
                            downloadLink.style.display = "none";

                            // Add the link to DOM
                            document.body.appendChild(downloadLink);

                            // Click download link
                            downloadLink.click();
                        }

                        function exportTableToCSV2(filename) {
                            var csv = [];
                            var rows = document.querySelectorAll("table.table_personal.dont tr");
                            
                            for (var i = 0; i < rows.length; i++) {
                                var row = [], cols = rows[i].querySelectorAll("td, th");
                                
                                for (var j = 0; j < cols.length; j++) 
                                    row.push(cols[j].innerText);
                                
                                csv.push(row.join(","));        
                            }

                            // Download CSV file
                            downloadCSV(csv.join("\n"), filename);
                        }

                    </script>
                </div>
                
            </div>
            
        </div>
    </div>
</section>

<?php 
	include('../../Elements/footer.php');
?>