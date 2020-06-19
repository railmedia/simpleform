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

    $fields = array('first_name' => 'First Name', 'last_name' => 'Last Name', 'email' => 'E-mail');
    foreach( $fields as $field => $label ) {
        if( ! isset( $_POST[ $field ] ) || ! $_POST[ $field ] ) {
            echo '<p><font color="red">' . $label . ' is required</font></p>';
        }
    }

    echo '<h2>Uploaded Data</h2>';

    foreach( $fields as $field => $label ) {
        echo '<p><strong>' . $label . '</strong>: ' . $_POST[$field] . '</p>';
    }

    $files = array('pdf_1' => 'PDF 1', 'pdf_2' => 'PDF 2');
    foreach( $files as $file => $label ) {
        // if( ! isset( $_POST[$file] ) ) {
        //     echo '<p><font color="orange">You did not upload the file ' . $label . '</font></p>';
        //     continue;
        // }
        $target_dir = "./";
        $_FILES[$file]["name"] =  strtolower( str_replace(' ', '-', $_POST['first_name'] ) ) . '_' . $_POST['suffix'] . '.pdf';
        $target_file = $target_dir . basename($_FILES[$file]["name"]);
        //echo '<p>' . basename( $_FILES[$file]["name"]) . '</p>';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
           echo '<p><font color="green">The file ' . basename( $_FILES[$file]["name"]) . ' has been uploaded. File URL is <a target="_blank" href="https://www.tudorache.me/simpleform/' . $_FILES[$file]["name"] . '">https://www.tudorache.me/simpleform/' . $_FILES[$file]["name"] . '</a></font></p>';
         } else {
           echo '<p><font color="red">Error uploading file in field ' . $file . '</font></p>';
         }
    }
?>
    <p><a href="/simpleform">Start Over</a></p>
<?php
} else {
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
<?php } ?>
</body>
</html>
