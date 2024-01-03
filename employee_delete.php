<?php
function employee_delete() {

    echo "employee delete";

    if(isset($_GET['id'])){

        global $wpdb;
        $table_name=$wpdb->prefix.'employee_list';
        $i=$_GET['id'];
        $wpdb->delete(
            $table_name,
            array('id'=>$i)
        );
        echo "Record Deleted!!";

    }
    echo "<script type='text/javascript'>window.location.href='http://192.168.1.128/gutenberg/wp-admin/admin.php?page=Employee_Listing';</script>";
}
?>
