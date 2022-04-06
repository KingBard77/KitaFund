<?php 
session_start();
include('../../connection.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ip = gethostbyname('www.google.com');

//Load Composer's autoloader
require '../../../PHPMailer/Exception.php';
require '../../../PHPMailer/PHPMailer.php';
require '../../../PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$Employee_Code = $_SESSION['Profile_Id'];
$Attendance_Message = $_POST['Attendance_Message'];
$Action_Name = $_POST['Action_Name'];

$sql = "INSERT INTO `attendance` ( `Action_Name`,`Attendance_Message`, `Employee_Code`)
 values ('$Action_Name',  '$Attendance_Message', '$Employee_Code')";

$query= mysqli_query($dbc,$sql);
$lastId = mysqli_insert_id($dbc);

$msgBody = '
    <h3 align="left">Employee Details</h3>
    <table border="0" width="80%" cellpadding="5" cellspacing="5">
        <tr>
            <td colspan="2">Hai Owner, <b>'.$_SESSION['Employee_Code'].'</b> have attend the <b>Application Attendance</b> for the following details:</td>
        </tr>
        <tr>
            <td width="10%">Action Name: </td>
            <td width="50%">'. $Action_Name.'</td>
        </tr>
        <tr>
            <td width="10%">Message: </td>
            <td width="50%">' .$Attendance_Message.'</td>
        </tr>
        <tr>
            <td colspan="2">* Thank You. Sincerely, BurgerByte Employee </td>
        </tr>
    </table>
';

if($query ==true)
{
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'BurgerByte1998@gmail.com';                     //SMTP username
        $mail->Password   = 'Adminstrator_1998';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('BurgerByte1998@gmail.com', 'Badrul');
        $mail->addAddress('BurgerByte1998@gmail.com', 'Ali');     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                 //Set email format to HTML
        $mail->Subject = 'Attendance';
        $mail->Body    = $msgBody;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>