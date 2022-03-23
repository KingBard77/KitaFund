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

$Leave_Status = $_POST['Leave_Status'];
$Leave_Message = $_POST['Leave_Message'];
$To_Date = $_POST['To_Date'];
$From_Date = $_POST['From_Date'];
$Leave_Type = $_POST['Leave_Type'];
$Employee_Code = $_SESSION['Profile_Id'];

$sql = "INSERT INTO `leaves` 
(`Employee_Code`,`Leave_Type`,`From_Date`,`To_Date`,`Leave_Message`,`Leave_Status`) 
values 
('$Employee_Code', '$Leave_Type', '$From_Date', '$To_Date', '$Leave_Message', '$Leave_Status')";

$query= mysqli_query($dbc,$sql);
$lastId = mysqli_insert_id($dbc);

$msgBody = '
    <h3 align="left">Employee Details</h3>
    <table border="0" width="80%" cellpadding="5" cellspacing="5">
        <tr>
            <td colspan="2">Hai Owner, <b>'.$_SESSION['Employee_Code'].'</b> have apply for the <b>Application Leave</b> for the following date:</td>
        </tr>
        <tr>
            <td width="10%">From Date: </td>
            <td width="50%"><b>'. $From_Date.'</b></td>
        </tr>
        <tr>
            <td width="10%">To Date: </td>
            <td width="50%"><b>'. $To_Date.'</b></td>
        </tr>
        <tr>
            <td width="10%">Leave Type: </td>
            <td width="50%">'. $Leave_Type.'</td>
        </tr>
        <tr>
            <td width="10%">Message: </td>
            <td width="50%">' .$Leave_Message.'</td>
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
        $mail->Subject = 'Leave Request';
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