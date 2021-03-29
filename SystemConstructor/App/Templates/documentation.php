<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/1/2020
 * Time: 9:34 AM
 */

?>

<html lang="en">
<head>
    <title>Line Documentation</title>
    <link rel="icon" href="<?php print \Absoft\App\Loaders\Resource::imageAddress("line.png"); ?>">
    <style><?php print \Absoft\App\Loaders\Loader::cssAddress("bootstrap.min.css"); ?></style>
</head>
<body>

<div class="container">

    <embed width="100%" height="700px" src="<?php print \Absoft\App\Loaders\Resource::loadDocuments("documentation.pdf"); ?>" type="Application/pdf">

</div>

</body>
</html>
