=== Stripe for LearnDash ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com/add-on/stripe/
LD Requires at least: 3.0
Slug: learndash-stripe
Tags: integration, payment gateway, stripe
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 1.4.0

Integrate LearnDash LMS with Stripe.

== Description ==

Integrate LearnDash LMS with Stripe.

LearnDash comes with the ability to accept payment for courses by leveraging PayPal. Using this add-on, you can quickly and easily accept payments using the Stripe payment gateway. Use it with PayPal, or just use Stripe - the choice is yours!

= Integration Features = 

* Accept payments using Stripe
* Automatic user creation and enrollment
* Compatible with built-in PayPal option
* Lightbox overlay

See the [Add-on](https://learndash.com/add-on/stripe/) page for more information.

== Installation ==

If the auto-update is not working, verify that you have a valid LearnDash LMS license via LEARNDASH LMS > SETTINGS > LMS LICENSE. 

Alternatively, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of the add-on.
1. Download the latest version of the add-on from our [support site](https://support.learndash.com/article-categories/free/).
1. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
1. Activate the add-on plugin via the PLUGINS menu.

== Changelog ==

= 1.4.0 =
* Added filter hook to allow bailing from processing webhook
* Added subscription cancellation handler
* Added logic for payment intent data not to be used other than for paynow product
* Added payment methods options update
* Added `get_payment_methods` helper and apply payment method options
* Added payment methods settings
* Added `invoice.payment_succeeded` webhook event handler
* Added `invoice.payment_failed` webhook event handler
* Added filter hook for checkout sca integration payment method types
* Added ideal to SCA payment methods
* Added test endpoint secret settings field
* Updated to rename webhook handler function
* Updated to set up Stripe session and store it in cookie to prevent multiple session creations in Stripe
* Updated call to `stripe_button` function only once
* Updated global exception
* Updated endpoint secret setter and getter and change endpoint secret retrieval to use getter method
* Updated admin script to accomodate test endpoint secret field
* Updated default username to use email address format and add filter to create short username if needed
* Fixed wrap session creation in try catch block to prevent fatal error and return button if session is not created
* Fixed non active subscription pass logic checks and enroll users to courses
* Fixed Bail process if payload or signature is empty
* Fixed undefined index error
* Fixed prevent creating Stripe session if the product type is not paynow or subscribe to prevent Stripe error
* Fixed ideal payment method addition logic
* Fixed change response code for `SignatureVerification` error
* Fixed ideal payment not available for currency other than euro
* Fixed duplicate customer creation in Stripe account because of unnecessary `add_stripe_customer()` call

View the full changelog [here](https://www.learndash.com/add-on/stripe/).