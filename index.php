<html>
<head>
    <title>Simple Form</title>
    <style type="text/css">
        body, html {
            font-family: Arial;
        }
    </style>
</head>
<body>
<h1>Simple Form</h1>
<?php
if( isset( $_POST['form_submitted'] ) ) {
    $validation = array('first_name' => 'First Name', 'last_name' => 'Last Name', 'email' => 'E-mail');
    foreach( $validation as $field => $label ) {
        if( ! isset( $_POST[ $field ] ) || ! $_POST[ $field ] ) {
            echo '<p><font color="red">' . $label . ' is required</font></p>';
        }
    }

    $files = array('pdf_1', 'pdf_2');
    foreach( $files as $file ) {
        $target_dir = "./";
        $_FILES[$file]["name"] =  strtolower( str_replace(' ', '-', $_POST['first_name'] ) ) . '_' . $_POST['suffix'] . '.pdf';
        $target_file = $target_dir . basename($_FILES[$file]["name"]);
        echo '<p>' . basename( $_FILES[$file]["name"]) . '</p>';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
           echo '<p><font color="green">The file ' . basename( $_FILES[$file]["name"]) . ' has been uploaded.</font></p>';
         } else {
           echo '<p><font color="red">Error uploading file in field ' . $file . '</font></p>';
         }
    }

}
?>
<form enctype="multipart/form-data" method="POST" action="">
    <p>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" />
    </p>
    <p>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" />
    </p>
    <p>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" />
    </p>
    <p>
        <label for="pdf_1">Upload PDF 1</label>
        <input type="file" id="pdf_1" name="pdf_1" />
    </p>
    <p>
        <label for="pdf_2">Upload PDF 2</label>
        <input type="file" id="pdf_2" name="pdf_2" />
    </p>
    <p>
        <label for="suffix">Filename suffix</label>
        <input type="text" id="suffix" name="suffix" value="suffix" />
    </p>
    <p>
        <button type="submit" name="form_submitted">Send</button>
    </p>
</form>
</body>
</html>
