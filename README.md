
# Custom Certhis Embedded Plugin

The Custom Certhis Embedded Plugin allows you to easily integrate Certhis Embedded into your WordPress site using a shortcode. You can display your Certhis NFT collection with various customization options, such as colors, fonts, and filtering options.

## Installation

1. Upload the `custom-certhis-embedded-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.

## Shortcode Usage

To use the Certhis Embedded shortcode, add the following code to your WordPress pages or posts:

Example: 

    [custom_certhis_embedded select="radio" header="off" collection_index="1156" google_font="Open Sans" color="#fafafa" color_2="#000000" background="#ffffff" title_color="#000000" button_text_color="#ffffff" text_color="#000000"]


You can customize the shortcode attributes to suit your needs:

- `select`: Choose the NFT selection mode (e.g., "radio" or "checkbox").
- `header`: Show or hide the header (e.g., "on" or "off").
- `collection_index`: Specify the Certhis collection index to display.
- `google_font`: Select a Google Font for the display.
- `color`: Customize the primary color of the NFT display.
- `color_2`: Customize the secondary color of the NFT display.
- `background`: Customize the background color of the NFT display.
- `title_color`: Customize the title color of the NFT display.
- `button_text_color`: Customize the button text color of the NFT display.
- `text_color`: Customize the text color of the NFT display.

If you select "Custom URL" as the NFT Page, you can provide a custom URL for each NFT using the `nft_data` attribute:

Example: 

    [custom_certhis_embedded select="radio" header="off" collection_index="1156" google_font="Open Sans" color="#fafafa" color_2="#000000" background="#ffffff" title_color="#000000" button_text_color="#ffffff" text_color="#000000" nft_page="Custom URL" nft_data="https://example.com/custom-nft-url"]


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
