<?php function employee_insert(){ ?>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <form name="frm" action="#" method="post" enctype="multipart/form-data">
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="nm"></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="lname"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Feature Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Address: </td>
                    <td><textarea type="text" name="adrs" rows="" cols=""></textarea></td>
                </tr>
                <tr>
                    <td>Designation: </td>
                    <td>
                        <select name="des">
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                            <option value="hr">HR</option>
                            <option value="manager">Manager</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mob no: </td>
                    <td><input type="number" name="mob"></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><input type="text" name="state"></td>
                </tr>
                <tr>
                    <td>Country: </td>
                    <td><input type="text" name="country"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="insert-btn" value="Insert" name="ins">
                        <input type="submit" class="Insert-btn" value="Reset" name="reset">
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
<?php
    if (isset($_POST['ins'])) {
        global $wpdb;
        $nm = $_POST['nm'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $ad = $_POST['adrs'];
        $d = $_POST['des'];
        $m = $_POST['mob'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $table_name = $wpdb->prefix . 'employee_list';

        // File upload path
        //$targetDir = ABSPATH . 'wp-content/uploads/';
        $targetDir = ABSPATH . 'wp-content/uploads/';
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        if (in_array($fileType, $allowTypes)) {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

                $wpdb->insert(
                    'your_images_table_name',
                    array(
                        'file_name' => $fileName,
                        'uploaded_on' => current_time('mysql'),
                    )
                );
                $statusMsg = "The file " . $fileName . " has been uploaded and data inserted successfully.";
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }

        echo $statusMsg;

        $wpdb->insert(
            $table_name,
            array(
                'name' => $nm,
                'lname' => $lname,
                'email' => $email,
                'image' => $fileName,
                'address' => $ad,
                'role' => $d,
                'contact' => $m,
                'state' => $state,
                'country' => $country
            )
        );
        exit;
    }
}
?>