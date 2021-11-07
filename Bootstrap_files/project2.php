<<html>
<head>
    <title>Sending Email along with Attachment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        body{
            /*background: #cb5ba3;
            background: -webkit-linear-gradient(to right, #cb5ba3, #00d4ff);
            background: linear-gradient(to right, #00d4ff, rgba(203,91,163,1)77%);*/
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode';
        }

    </style>
</head>
<body>
<br>
<div class="container">
    <div class="text text-center">
        <h1>Sending an Email Using PHP along with Attachment</h1>
        <form class="form-group" enctype="multipart/form-data" method="POST" action="">
            <div class="text text-center">
            <label>Your Name <input class="form-control" required type="text" name="sender_name" /> </label> <br><br>
            <label>Your Email <input type="email" required class="form-control" name="sender_email" /> </label> <br><br>
            <label>Subject <input type="text" name="subject" required class="form-control"/> </label> <br><br>
            <label>Message <textarea name="message" required class="form-control"></textarea> </label> <br><br>
            <label>Attachment <input type="file" required name="attachment" class="form-control" style="width:6cm;" /></label> <br><br>
            <label><input type="submit" name="button" value="Submit" class="form-control"  /></label> <br><br>
            </div>
        </form>
    </div>
</div>
<?php
// the message
//print_r($_FILES);
if(isset($_POST['button']) && isset($_FILES['attachment']))
{

    $from_email      = 'sexample12345678@gmail.com'; //from mail, sender email addrress
    $recipient_email = 'gayatrib136@gmail.com'; //recipient email addrress

    //Load POST data from HTML form
    $sender_name = $_POST["sender_name"]; //sender name
    $reply_to_email = $_POST["sender_email"]; //sender email, it will be used in "reply-to" header
    $subject     = $_POST["subject"]; //subject for the email
    $message     = $_POST["message"]; //body of the email


    /*Always remember to validate the form fields like this
    if(strlen($sender_name)<1)
    {
        die('Name is too short or empty!');
    }
    */

    //Get uploaded file data using $_FILES array
    $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
    $name    = $_FILES['attachment']['name']; // get the name of the file
    $size    = $_FILES['attachment']['size']; // get size of the file for size validation
    $type    = $_FILES['attachment']['type']; // get type of the file
    $error   = $_FILES['attachment']['error']; // get the error (if any)

    //validate form field for attaching the file
    if($error > 0)
    {
        die('Upload error or No files uploaded');
    }

    //read from the uploaded file & base64_encode content
    $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    fclose($handle);                 // close upon completion

    $encoded_content = chunk_split(base64_encode($content));

    $boundary = md5("random"); // define boundary with a md5 hashed value

    //header
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
    $headers .= "From:".$from_email."\r\n"; // Sender Email
    $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email addrress to reach back
    $headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary

    //plain text
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));

    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $type; name=".$name."\r\n";
    $body .="Content-Disposition: attachment; filename=".$name."\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
    //$body .= $encoded_content; // Attaching the encoded file with email

    $sentMailResult = mail($recipient_email, $subject, $body, $headers);

    if($sentMailResult)
    {
        echo "<script>alert('File Sent Successfully.');</script>";
        //unlink($name); // delete the file after attachment sent.
    }
    else
    {
        die("Sorry but the email could not be sent.
                    Please go back and try again!");
    }
}
?>
</body>
</html>
html>
<head>
    <title>Sending Email along with Attachment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        body{
            /*background: #cb5ba3;
            background: -webkit-linear-gradient(to right, #cb5ba3, #00d4ff);
            background: linear-gradient(to right, #00d4ff, rgba(203,91,163,1)77%);*/
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode';
        }

    </style>
</head>
<body>
<br>
<div class="container">
    <div class="text text-center">
        <h1>Sending an Email Using PHP along with Attachment</h1>
        <form class="form-group" enctype="multipart/form-data" method="POST" action="">
            <div class="text text-center">
            <label>Your Name <input class="form-control" required type="text" name="sender_name" /> </label> <br><br>
            <label>Your Email <input type="email" required class="form-control" name="sender_email" /> </label> <br><br>
            <label>Subject <input type="text" name="subject" required class="form-control"/> </label> <br><br>
            <label>Message <textarea name="message" required class="form-control"></textarea> </label> <br><br>
            <label>Attachment <input type="file" required name="attachment" class="form-control" style="width:6cm;" /></label> <br><br>
            <label><input type="submit" name="button" value="Submit" class="form-control"  /></label> <br><br>
            </div>
        </form>
    </div>
</div>
<?php
// the message
//print_r($_FILES);
if(isset($_POST['button']) && isset($_FILES['attachment']))
{

    $from_email      = 'sexample12345678@gmail.com'; //from mail, sender email addrress
    $recipient_email = 'gayatrib136@gmail.com'; //recipient email addrress

    //Load POST data from HTML form
    $sender_name = $_POST["sender_name"]; //sender name
    $reply_to_email = $_POST["sender_email"]; //sender email, it will be used in "reply-to" header
    $subject     = $_POST["subject"]; //subject for the email
    $message     = $_POST["message"]; //body of the email


    /*Always remember to validate the form fields like this
    if(strlen($sender_name)<1)
    {
        die('Name is too short or empty!');
    }
    */

    //Get uploaded file data using $_FILES array
    $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
    $name    = $_FILES['attachment']['name']; // get the name of the file
    $size    = $_FILES['attachment']['size']; // get size of the file for size validation
    $type    = $_FILES['attachment']['type']; // get type of the file
    $error   = $_FILES['attachment']['error']; // get the error (if any)

    //validate form field for attaching the file
    if($error > 0)
    {
        die('Upload error or No files uploaded');
    }

    //read from the uploaded file & base64_encode content
    $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    fclose($handle);                 // close upon completion

    $encoded_content = chunk_split(base64_encode($content));

    $boundary = md5("random"); // define boundary with a md5 hashed value

    //header
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
    $headers .= "From:".$from_email."\r\n"; // Sender Email
    $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email addrress to reach back
    $headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary

    //plain text
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));

    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $type; name=".$name."\r\n";
    $body .="Content-Disposition: attachment; filename=".$name."\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
    //$body .= $encoded_content; // Attaching the encoded file with email

    $sentMailResult = mail($recipient_email, $subject, $body, $headers);

    if($sentMailResult)
    {
        echo "<script>alert('File Sent Successfully.');</script>";
        //unlink($name); // delete the file after attachment sent.
    }
    else
    {
        die("Sorry but the email could not be sent.
                    Please go back and try again!");
    }
}
?>
</body>
</html>
