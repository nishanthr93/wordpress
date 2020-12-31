=== LearnDash Notifications ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com/add-on/learndash-notifications/
LD Requires at least: 3.0
Slug: learndash-notifications
Tags: notifications, emails
Requires at least: 4.9
Tested up to: 4.9
Requires PHP: 7.0
Stable tag: 1.3.1

Send email notifications based on LearnDash actions.

== Description ==

Send email notifications based on LearnDash actions.

This add-on enables a new level of learner engagement within your LearnDash courses. Configure various notifications to be sent out automatically based on what learners do (and do not do) in a course.

This is a perfect tool for bolstering learner engagement, encouragement, promotions, and cross-selling.

= Add-on Features = 

* Automatically Send Notifications
* 13 Available Triggers
* 34 Dynamic Shortcodes
* Delay Notifications
* Choose Recipients

See the [Add-on](https://learndash.com/add-on/learndash-notifications/) page for more information.

== Installation ==

If the auto-update is not working, verify that you have a valid LearnDash LMS license via LEARNDASH LMS > SETTINGS > LMS LICENSE. 

Alternatively, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of the add-on.
1. Download the latest version of the add-on from our [support site](https://support.learndash.com/article-categories/free/).
1. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
1. Activate the add-on plugin via the PLUGINS menu.

== Changelog ==

= 1.3.1 =
* Add: trigger in email header for essay and comment notification so its content can be filtered using wp_mail filter hook
* Add: default charset and collate for DB table creation
* Add: course enrollment notification trigger via course group addition workflow
* Fix: format attr value is not taken in ld_notifications shortcode
* Fix: some PHP errors
* Improve: delete lesson availale scheduled emails if access date has passed the current time
* Improve: add bypass transient param for LD functions related to getting group IDs
* Improve: don't wpautop email content if it's HTML email
NOT-202: re-merge essay submitted and quiz submitted trigger
* Improve: shortcode attribute check logic
* Improve: change default charset to utf8mb4 and bump DB version for update
* Improve: update DB column data types
* Add: lesson_id and topic_id to quiz triggers email sending function
* Add: quiz sumbitted trigger and add set global quiz result function
* Add: submit essay trigger
* Add: filter to decide whether to send notification or not
* Add: filter to disable not logged in notification for all courses
* Add: bcc to the fix recipient tool
* Add: categories result output to quiz shortcode, bump
* Improve: change code section with set global function
* Add: undefined shortcode atts in send_delayed_emails() function
* Add: filter hook to allow filter comment notification recipients
* Add: default value to notification param in learndash_notifications_get_recipients_emails()
* Add: documentation text for course enrollment trigger via group
* Add: filter hook for course expires notification
* Add: empty DB table tool
* Add: custom file debug function
* Fix: group_users data doesn't retrieve the latest users
* Improve: change trigger text label
* Fix: recipient tool by deleteing duplicate emails with the same recipient and shortcode data
* Fix: scheduled notification recipients tool
* Fix: scheduled notification recipient update
* Fix: typo on course ID
* Fix: enroll course via group trigger
* Fix: quiz trigger send all notifications to user if admin mark a quiz as completed
* Fix: group leader recipient for group enrollment trigger
* Fix: php warning in learndash_notifications_course_expires_after()
* Fix: SQL regex pattern to prevent duplicate scheduled notifications
* Fix: HTML tag stripped in notification content
* Improve: backward compatibility with PHP < 7
* Improve: filter duplicate emails from recipient emails
* Improve: don't allow notification with empty recipients to be stored in DB
* Improve: allow emails to be sent even when the recipient is empty


View the full changelog [here](https://www.learndash.com/add-on/learndash-notifications/).