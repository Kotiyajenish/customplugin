<?php function employee_list()
{ ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }

        .wrap {
            margin: 20px;
        }

        .wp-list-table {
            width: 100%;
            border-collapse: collapse;
        }

        .wp-list-table th,
        .wp-list-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .wp-list-table th {
            background-color: #f2f2f2;
        }

        .wp-list-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .wp-list-table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .wp-list-table img {
            max-width: 100px;
            max-height: 100px;
        }

        td img {
            width: 100% !important;
            max-width: 100px;
            object-fit: cover;
        }

        td {
            vertical-align: middle !important;
            text-align: center !important;
        }

        th {
            text-align: center !important;
        }
    </style>
    <div class="wrap">
        <table class="wp-list-table widefat fixed striped table-view-list pages">
            <thead>
                <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'employee_list';
                $employees = $wpdb->get_results("SELECT id,name,lname,email,image,address,contact,role,state,country from $table_name");
                $counter = 1;
                foreach ($employees as $employee) {
                ?>
                    <tr>
                        <td><?= $counter; ?></td>
                        <td><?= $employee->name; ?></td>
                        <td><?= $employee->lname; ?></td>
                        <td><?= $employee->email; ?></td>
                        <td>
                            <?php $image_url = site_url() . '/wp-content/uploads/' . $employee->image; ?>
                            <img src="<?php echo $image_url; ?>" alt="" style="width:100px;height:100px">
                        </td>
                        <td><?= $employee->address; ?></td>
                        <td><?= $employee->role; ?></td>
                        <td><?= $employee->contact; ?></td>
                        <td><?= $employee->state; ?></td>
                        <td><?= $employee->country; ?></td>
                        <td><a href="<?php echo admin_url('admin.php?page=Employee_Update&id=' . $employee->id); ?>" class="updatebtn"><i class="fas fa-edit"></i></a></td>
                        <td><a class="second" href="<?php echo admin_url('admin.php?page=Employee_Delete&id=' . $employee->id); ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php
                    $counter++;
                } ?>
            </tbody>
        </table>
    </div>
<?php }
add_shortcode('short_employee_list', 'employee_list'); ?>