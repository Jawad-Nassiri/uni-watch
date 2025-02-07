<?php include "../public/header.html.php" ?>

<div class="payment-container">
    <div class="payment-box">
        <div class="info-container">
            <form action="">
                <div class="fname-lname">
                    <div class="f-name">
                        <label for="f-name">First Name</label>
                        <input type="text" id="f-name" placeholder="Your first name">
                    </div>

                    <div class="l-name">
                        <label for="l-name">Last Name</label>
                        <input type="text" id="l-name" placeholder="Your last name">
                    </div>
                </div>

                <div class="email-container">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Your email address">
                </div>

                <div class="address-container">
                        <label for="address">Address</label>
                        <input type="email" id="email" placeholder="Your address">
                </div>

                <div class="button-container">
                    <button>Continue To Payment</button>
                </div>
            </form>
        </div>

        <div class="detail-payment-container"></div>
    </div>
</div>






<?php include "../public/footer.html.php" ?>
