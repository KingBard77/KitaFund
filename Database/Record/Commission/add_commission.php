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
$Account_No = $_POST['Account_No'];
$Bank_Name = $_POST['Bank_Name'];
$Commission_Status = $_POST['Commission_Status'];
$Commission_Message = $_POST['Commission_Message'];
$Commission_Date = $_POST['Commission_Date'];


$sql = "INSERT INTO `comission` (`Account_No`, `Bank_Name`, `Commission_Message`, `Employee_Code`, `Commission_Status` )
values ('$Account_No' , '$Bank_Name' , '$Commission_Message' , '$Employee_Code' , '$Commission_Status')";


$query= mysqli_query($dbc,$sql);
$lastId = mysqli_insert_id($dbc);

$msgBody = '
    <h3 align="left">Employee Details</h3>
    <table border="0" width="80%" cellpadding="5" cellspacing="5">
        <tr>
            <td colspan="2">Hai, <b>'.$_SESSION['Employee_Code'].'</b> have apply for the <b>Application Commission</b> for the following details:</td>
        </tr>
        <tr>
            <td width="10%">Bank Name: </td>
            <td width="50%">'. $Bank_Name.'</td>
        </tr>
        <tr>
            <td width="10%">Account Number: </td>
            <td width="50%">'. $Account_No.'</td>
        </tr>
        <tr>
            <td width="10%">Message: </td>
            <td width="50%">' .$Commission_Message.'</td>
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
        $mail->Username   = 'badamin16@gmail.com';                     //SMTP username
        $mail->Password   = 'KingAmin_77';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('badamin16@gmail.com', 'Badrul');
        $mail->addAddress('badamin16@gmail.com', 'Ali');     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                 //Set email format to HTML
        $mail->Subject = 'Commssion Request';
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