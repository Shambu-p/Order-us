<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 8:42 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

    <form action="<?php print $this->route_address("Orders.more_info"); ?>" method="post">

        <h2 class="display-5" style="text-align: center;">
            More Information About the Order
        </h2>
        <br>

        <div class="form-group">
            <label for="fullName">
                Full Name
            </label>
            <input type="text" class="form-control form-control-lg" id="fullName" required name="name" placeholder="Full Name">
        </div>
        <div class="form-group">
    
            <label for="additionalText">
                Additional Preference
            </label>
            <textarea class="form-control" id="additionalText" name="additional_text" rows="3" required></textarea>
    
        </div>
    
        <div class="form-group">
            <label for="email">Your Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
        </div>
        <br>
    
        <div class="form-group">
            <label for="phone">
                Phone Number
            </label>
            <input type="number" class="form-control" name="phone_number" id="phone" placeholder="Your working Phone Number" required>
        </div>

        <div class="form-group">
            <label for="address">
                Here Enter your address if you want us to deliver to you at your place. <br>
                <strong>
                    <u>
                        you should know that it will cost you. and the cost will be added on the payment.
                        The place you enter should be inside the city otherwise we can\'t deliver you the product you will only west your money
                    </u>
                </strong>
            </label>

            <textarea type="text" class="form-control" id="address" name="address" ></textarea>

        </div>
    
        <div class="form-group">
            <label for="new_password">Create Password</label>
            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Create Password" required>
        </div>
    
        <div class="form-group">
            <label for="confirm_pass">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_pass" placeholder="Confirm Password" required>
        </div>
    
        <button class="btn btn-dark" type="submit" name="shirt_design">
            Submit
        </button>

    </form>

<?php
$this->loadTemplate("layouts/order_header.php");
