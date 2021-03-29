<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/19/2020
 * Time: 2:14 PM
 */

print '



';

?>

<html lang="en">
<head>
    <title>Contact Us</title>
    <link rel="icon" href="<?php print \Absoft\App\Loaders\Resource::imageAddress("line.png");?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
    body, html {
        height: 100%;
        color: #777;
        line-height: 1.8;
    }

    /* Create a Parallax Effect */
    .bgimg-1, .bgimg-2, .bgimg-3 {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .w3-wide {letter-spacing: 10px;}
    .w3-hover-opacity {cursor: pointer;}

    /* Turn off parallax scrolling for tablets and phones */
    @media only screen and (max-device-width: 1600px) {
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: scroll;
            min-height: 400px;
        }
    }
</style>
<style><?php print \Absoft\App\Loaders\Loader::cssAddress("w3.css"); ?></style>
<style><?php print \Absoft\App\Loaders\Loader::cssAddress("font-awesome.min.css"); ?></style>


<div class="w3-content w3-container w3-padding-64" id="contact">
    <h3 class="w3-center">CONTACT US</h3>
    <p class="w3-center"><em>We would love your feedback</em></p>

    <div class="w3-row w3-padding-32 w3-section">
        <div class="w3-col m4 w3-container">
            <img src="<?php print \Absoft\App\Loaders\Resource::imageAddress("line.png"); ?>" class="w3-image w3-round" alt="no image" style="width:100%">
        </div>
        <div class="w3-col m8 w3-panel">
            <div class="w3-large w3-margin-bottom">
                ADAMA, ETHIOPIA<br>
                Phone: +251 94 333 7884<br>
                Email: babbikebede21@gmail.com<br>
            </div>
            <p>You can call or leave us Message</p>
            <form action="https://www.w3schools.com/action_page.php" method="post" target="_blank">
                <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                    <div class="w3-half">
                        <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
                    </div>
                    <div class="w3-half">
                        <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
                    </div>
                </div>
                <textarea class="w3-inpute w3-border" placeholder="Message" required name="Message" style="width: 100%;"> </textarea><br>
                <button class="w3-button w3-black w3-cell-middle w3-section" type="submit">
                    SEND MESSAGE
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
