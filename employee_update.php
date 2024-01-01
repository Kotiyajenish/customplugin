<?php function employee_update(){
    $i = $_GET['id'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_list';
    $employees = $wpdb->get_results("SELECT id,name,email,image,address,contact,role,state,country from $table_name where id=$i");
    echo $employees[0]->id;
?>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <form name="frm" action="#" method="post">
                <input type="hidden" name="id" value="<?= $employees[0]->id; ?>">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="nm" value="<?= $employees[0]->name; ?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" value="<?= $employees[0]->email; ?>"></td>
                </tr>
                <tr>
                    <td>Feature Image:</td>
                    <td>
                        <?php $image = site_url() . '/wp-content/uploads/' . $employees[0]-> image; ?>
                        <img src="<?php echo $image;?>" style="width:100px; height:100px">
                    </td>
                    <td>
                        <input type="file" name="image" class="img-drag">
                    </td>

                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" name="adrs" value="<?= $employees[0]->address; ?>"></td>
                </tr>
                <tr>
                    <td>Desigination:</td>
                    <td><select name="des">
                            <option value="developer" <?php if ($employees[0]->role == "developer") {
                                                            echo "selected";
                                                        } ?>>Developer</option>
                            <option value="designer" <?php if ($employees[0]->role == "designer") {
                                                            echo "selected";
                                                        } ?>>Designer</option>
                            <option value="hr" <?php if($employees[0]->role == "hr"){
                                                    echo  "selected";
                                                    }?>>Hr</option>
                            <option value="hr" <?php if($employees[0]->role == "manager"){
                                                    echo  "selected";
                                                    }?>>Manager</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mob no:</td>
                    <td><input type="number" name="mob" value="<?= $employees[0]->contact;?>"></td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td><input type="text" name="state" value="<?= $employees[0]->state;?>"></td>
                </tr>
                <tr>
                    <td>country:</td>
                    <td><input type="text" name="country" value="<?= $employees[0]->country;?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update" name="upd"></td>
                </tr>
            </form>
        </tbody>
    </table>
<?php
}
if (isset($_POST['upd'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_list';
    $id = $_POST['id'];
    $nm = $_POST['nm'];

    $wpdb->update(
        $table_name,
        array(
            'name' => $nm
        ),
        array(
            'id' => $id
        )
    );
    $url = admin_url('admin.php?page=Employee_List');
}
?>