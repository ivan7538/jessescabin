=== Aquentro ===
Contributors: MotoPress
Tags: translation-ready, custom-background, theme-options, custom-menu, post-formats, threaded-comments
Requires at least: 4.6
Tested up to: 5.5
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Aquentro is an urban-style single property WordPress theme for all types of units from high-end luxury apartments to hotels. The main theme demo is optimized a single property for rent, but thanks to the premium WordPress reservation plugin integrated for free, it can be used for unlimited properties.

== Installation ==
1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now. Click Activate.
3. Install required plugins.
4. If you create a new website, you may import sample data in Appearance > Import Demo Data.

== Copyright ==
Aquentro WordPress Theme, Copyright (C) 2019, MotoPress
Aquentro is distributed under the terms of the GNU GPL.

== Frequently Asked Questions ==
= Does this theme support any plugins? =
Aquentro includes support for Jetpack and MotoPress Hotel Booking plugin.

== Changelog ==

= 1.3.2, Aug 31 2020 =
* Added theme support for Stratum plugin - collection of 20+ advanced Elementor widgets with extensive functionality.

= 1.3.1, Aug 12 2020 =
* Added ability to control footer height.
* Added ability to change image in footer.
* Minor bugfixes and improvements.

= 1.3.0, Nov 19 2019 =
* Minor bugfixes and improvements.
* Hotel Booking plugin updated to version 3.7.1.
  * Improved blocks compatibility with the new versions of the Gutenberg editor.
  * Added customer email address to the Stripe payment details.
  * Fixed an issue where the price breakdown was not displayed in the new booking emails.
  * Fixed an issue at checkout when coupon discount was not applied to the total price at the bottom of the page.
  * Fixed a bug concerning impossibility to complete Stripe payment after applying the coupon code.
  * Fixed an issue where the type of the coupon code was changed after its use.
  * Improved the "Booking Confirmed" page with regard to displaying information on client's booking and payment in case the booking is paid online. Follow the prompts to update the content of the "Booking Confirmed" page automatically or apply the changes manually.
  * Added the new email tag, which allows guests to visit their booking details page directly from the email. Important: you need to update your email templates to start using this functionality.
  * New actions and filters were added for developers.
  * Fixed the issue at checkout when a variable price was not applied if capacity is disabled in plugin settings.
  * Added Direct Bank Transfer as a new payment gateway.
  * Added the ability to delete ical synchronization logs automatically.
  * Added new intervals for importing bookings through the ical "Quarter an Hour" and "Half an Hour".
  * The user information is no longer required while creating a booking in the admin panel. You can enable it again in the settings.
  * Added new tags for email templates: Price Breakdown, Country, State, City, Postcode, Address, Full Guest Name.
  * Added the ability to select the accommodation type while duplicating rates.
  * Improvement: now if the accommodation type size is not set, the field will not be displayed on the website.
  * Implemented bookings synchronization with Expedia travel booking website.
  * Updated PayPal and Stripe payment integrations to comply with PSD2 and the SCA requirements.
  * Added the ability to receive payments through Bancontact, iDEAL, Giropay, SEPA Direct Debit and SOFORT payment gateways via the updated Stripe API.

= 1.2.2, Jul 10 2019 =
* Hotel Booking plugin updated to version 3.5.1.
  * Major improvements on booking synchronization with online channels via iCal interface.
  * Added the ability to export bookings data in the CSV format.

= 1.2.1, Apr 15 2019 =
* Hotel Booking plugin updated to version 3.3.0.
  * Improved compatibility with WPML plugin.
  * Fixed the bug appeared while calculating the subtotal amount in Price Breakdown when a discount code is applied.
  * Added Hotel Booking Extensions page. Developers may opt-out of displaying this page via "mphb_show_extension_links" filter.
  * Booking Calendar improvements:
    * Tooltip extended with the customer data: full name, email, phone, guests number, imported bookings info.
    * Added a popup option to display the detailed booking information.
  * Bookings table improvements:
    * Added a column with booked accommodations.
    * Added the ability to filter bookings by accommodation type.
    * Added the ability to search bookings by First Name, Last Name, Check-in Date, Check-out Date, Phone, Price, etc.
  * Added a Service option that enables to specify the number of times guest would like to order this service.

= 1.2.0, Feb 13 2019 =
* Hotel Booking plugin updated to version 3.1.0.
  * Added new blocks to Gutenberg.
  * Added option to switch to the new block editor for Accommodation Types and Services in plugin settings.
* Added option to set the Price Breakdown to be unfolded by default.
* Improved design of Accommodation titles in Price Breakdown for better user experience.
* Added styles for Hotel Booking Reviews addon.
* Added the ability to change copyright text in footer.
* Minor bugfixes and improvements.

= 1.1.0, Sep 18 2018 =
* Hotel Booking plugin updated to version 3.0.0:
  * Introducing attributes. By using the attributes you are able to define extra accommodation data such as location and type and use these attributes in the search availability form as advanced search filters.
  * Improved the way to display the booking rules in the availability calendar.
  * Added the new payment method to pay on arrival.
  * Added the ability to create fixed amount coupon codes.
  * Added the availability to send multiple emails to notify the administrator and other staff about new booking.
  * Fixed the bug appeared in the Braintree payment method if a few plugins for making payment are set up.
  * Added the ability to set the default country on the checkout page.
* Added the ability to change primary colors.

= 1.0.0, Aug 2 2018 =
* Hotel Booking plugin updated to version 2.7.6:
  * A new way to display available/unavailable dates in a calendar using a diagonal line (half-booked day). This will properly show your guests that they are able to use the same date as check in/out one.
  * Disabled predefined parameters for Adults and Children on the checkout page to let guests have more perceived control over options they choose.
  * Fixed the issue with booking rules and WPML. Now all translations of accommodations are not displayed in a list and the booking rules are applied to all translations.
  * Fixed the issue with Stripe when creating a booking from the backend.
  * Fixed the issue with the booking rules not applying while checking an accommodation availability with the "Skip search results" enabled.
  * Added a new feature "Guest Management". It is currently in beta and applied only to the frontend. Here are the main options of this feature:
    * Hide "adults" and "children" fields within search availability forms.
    * Disable "children" option for the website (hide "children" field and use Guests label instead).
    * Disable "adults" and "children" options.
  * Replaced "Per adult" label with a more catch-all term "per guest" for Services.
  * Increased the number of digits after comma for setting a per-night price. This will help you set accurate prices for weekly, monthly and custom rates.
  * Improved the way to display a rate pricing on the checkout page: the price is updated automatically based on the number of guests if there are any per-guest price variables.
  * Added the Availability Calendar shortcode.
  * Added sorting parameters to shortcodes.
  * Added all missing currencies to the list of currencies.

= 0.0.9, Jul 27 2018 =
* Initial release

== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* jQuery FlexSlider, code is licensed under GPLv2 License, (C) 2012 WooThemes, Contributing Author: Tyler Smith, https://github.com/woothemes/FlexSlider#general-notes
* Photos, photos from https://www.pexels.com/ are licensed under the Creative Commons Zero (CC0) license https://www.pexels.com/photo-license/