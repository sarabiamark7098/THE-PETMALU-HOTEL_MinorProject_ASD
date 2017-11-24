    <?php
    session_start();

    include 'connection.php';

    $success = false;

    $check_in = $_SESSION['check_in'];
    $check_out = $_SESSION['check_out'];
    $room_no = $_SESSION['room_no'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $middleI = $_SESSION['middleI'];
    $address = $_SESSION['address'];
    $contact_no = $_SESSION['contact_no'];
    $email_add = $_SESSION['email_add'];
    $mail = $_SESSION['mail'];
    $card_holder_name = $_SESSION['card_holder_name'];
    $card_number = $_SESSION['card_number'];
    $card_code = $_SESSION['card_code'];
    $payment_method = $_SESSION['payment_method'];

    $date_no = 0;
    
    if(isset($_GET['submit'])) {

        $queryGetHotelId = "SELECT hotel_id FROM hotel";
        echo $queryGetHotelId."<br>";
        $resultGetHotelId = mysqli_query($connection, $queryGetHotelId);
        while($row = mysqli_fetch_assoc($resultGetHotelId)) {
            $hotel_id = $row['hotel_id'];
        }

        echo $hotel_id."<br>";

        if(isset($check_in) && isset($check_out)) {
            $booking_date = date("Y-m-d");
            $queryInsertDate  = "INSERT INTO booking_date (check_in, check_out, booking_date) ";
            $queryInsertDate .= "VALUES ";
            $queryInsertDate .= "('{$check_in}', '{$check_out}', '{$booking_date}')";
            echo $queryInsertDate."<br>";
            $resultInsertDate = mysqli_query($connection, $queryInsertDate);

            $queryGetDateNo = "SELECT date_no FROM booking_date";
            echo $queryGetDateNo."<br>";
            $resultGetDateNo = mysqli_query($connection, $queryGetDateNo);
            while($row = mysqli_fetch_assoc($resultGetDateNo)) {
               $date_no = $row['date_no'];
            }
            echo $date_no."<br >";

           if($resultInsertDate && $resultGetDateNo) {
               $success = true;
           }
        }

        if(isset($room_no)) {
            $queryUpdateRoomAvail  = "UPDATE avail SET ";
            $queryUpdateRoomAvail .= "avail = 1 ";
            $queryUpdateRoomAvail .= "WHERE room_no = $room_no";
            echo $queryUpdateRoomAvail."<br>";
            $resultUpdateRoomAvail = mysqli_query($connection, $queryUpdateRoomAvail);

            $queryInsertDateAvail  = "INSERT INTO date_avail ";
            $queryInsertDateAvail .= "(date_no, room_no) ";
            $queryInsertDateAvail .= "VALUES ";
            $queryInsertDateAvail .= "($date_no, $room_no)";
            $resultInsertDateAvail = mysqli_query($connection, $queryInsertDateAvail);

            if($resultUpdateRoomAvail && $resultInsertDateAvail) {
                $success = true;
            }
        }

        if(isset($card_holder_name) && isset($card_number) && isset($card_code) && isset($payment_method)) {
            $queryInsertPayment  = "INSERT INTO payment (card_holder_name, card_number, card_code, payment_method, status) ";
            $queryInsertPayment .= "VALUES ";
            $queryInsertPayment .= "('". $card_holder_name ."' , '". $card_number ."', '". $card_code ."', '". $payment_method ."', 'PENDING')";
            $resultInsertPayment = mysqli_query($connection, $queryInsertPayment);
            echo $queryInsertPayment."<br>";

            $queryGetPaymentNo = "SELECT payment_no FROM payment";
            $queryGetPaymentNo."<br>";
            $resultGetPaymentNo = mysqli_query($connection, $queryGetPaymentNo);
            while($row = mysqli_fetch_assoc($resultGetPaymentNo)) {
                $payment_no = $row['payment_no'];
            }
            echo $payment_no."<br>";

            if($resultInsertPayment && $resultGetPaymentNo) {
                $success = true;
            }
        }

        if(isset($firstname) && isset($lastname) && isset($middleI) && isset($address) && isset($contact_no) && isset($email_add) && isset($mail) && isset($payment_no)) {
            $queryInsertGuest  = "INSERT INTO guest (firstname, lastname, middle_Initial, address, contact_no, email_address, mail, payment_no) "; 
            $queryInsertGuest .= "VALUES ('".$firstname."', '".$lastname."', '".$middleI."', '".$address."', '".$contact_no."', '".$email_add."', '".$mail."', ". $payment_no .")";
            echo $queryInsertGuest."<br>";
            $resultInsertGuest = mysqli_query($connection, $queryInsertGuest);

            $queryGetGuestID = "SELECT guest_id FROM guest";
            echo $queryGetGuestID."<br>";
            $resultGetGuestId = mysqli_query($connection, $queryGetGuestID);
            while($row = mysqli_fetch_assoc($resultGetGuestId)) {
                $guest_id = $row['guest_id'];
            }
            echo $guest_id."<br>";   

            if($resultInsertGuest && $resultGetGuestId) {
                $success = true;
            }
        }

        if(isset($date_no) && isset($room_no) && isset($guest_id) && isset($hotel_id)) {
            $queryInsetBooking  = "INSERT INTO booking (room_no, hotel_id, date_no, guest_id, confirm) ";
            $queryInsetBooking .= "VALUES ";
            $queryInsetBooking .= "(".$room_no.", ".$hotel_id.", ".$date_no.", ".$guest_id.", 0)";
            echo $queryInsetBooking."<br>";
            $resultInsertBooking = mysqli_query($connection, $queryInsetBooking);

            if($resultInsertBooking) {
                $success = true;
            }
        }

        if($success === true) {
            header("Location: submit.php");
            unset($_SESSION['check_in']);
            unset($_SESSION['check_out']);
            unset($_SESSION['room_no']);
            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['middleI']);
            unset($_SESSION['address']);
            unset($_SESSION['contact']);
            unset($_SESSION['email_add']);
            unset($_SESSION['mail']);
            unset($_SESSION['card_holder_name']);
            unset($_SESSION['card_number']);
            unset($_SESSION['card_code']);
            unset($_SESSION['payment_method']);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   
?>