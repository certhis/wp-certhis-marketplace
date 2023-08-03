
# Custom Certhis Embedded Plugin

The Custom Certhis Embedded Plugin allows you to easily integrate Certhis Embedded into your WordPress site using a shortcode. You can display your Certhis NFT collection with various customization options, such as colors, fonts, and filtering options.

## Installation

1. Upload the `custom-certhis-embedded-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.

## Shortcode Usage

To use the Certhis Embedded shortcode, add the following code to your WordPress pages or posts:

Example: 

    [custom_certhis collection_index="1201" column="3" column_mobile="1" nft_page="popup" filter_minted="on" google_font="Arial" color="#F8592" color_2="#F8592" filter_search="on"]



## Frequently Asked Questions

1. Can I use this plugin with any Certhis collection?
   - Yes, you can use the `collection_index` attribute to specify the Certhis collection index you want to display.

2. Can I change the number of columns in the NFT display?
   - Yes, you can use the `column` and `column_mobile` attributes to set the number of columns for desktop and mobile views, respectively.

3. How can I customize the colors and fonts of the NFT display?
   - You can use the `color`, `color_2`, and `google_font` attributes to customize the colors and fonts of the NFT display.

## Changelog

### 1.0
- Initial release.

## License

GPLv2 or later
