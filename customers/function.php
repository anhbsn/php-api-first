<?php

require '../inc/dbcon.php';

function getCustomerList(){

    global $conn;
    $query = "SELECT * FROM customers";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        
        if(mysqli_num_rows($query_run) > 0) {

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Customer Fetch Successful',
                'data' => $res
            ];
            header("HTTP/1.1 200 OK");
            return json_encode($data);

        } else {
            $data = [
                'status' => 404,
                'message' => 'No Found'
            ];
            header("HTTP/1.1 404 No Found");
            return json_encode($data);
        }

    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.1 500 Internal Server Error");
        return json_encode($data);
    }

}

?>