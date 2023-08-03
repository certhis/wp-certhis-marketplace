<?php
/*
Plugin Name: NFT MARKETPLACE Plugin
Description: A plugin to easily integrate Certhis Embedded and customize data attributes.
Version: 1.0
Author: Adam-Certhis
*/


function custom_certhis_enqueue_scripts()
{
    wp_enqueue_style('custom-certhis-style', plugin_dir_url(__FILE__) . 'custom-certhis-style.css');
    wp_enqueue_script('select2-script', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'); // Enqueue Select2 from CDN
    wp_enqueue_style('select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'); // Enqueue Select2 CSS from CDN
    wp_enqueue_style('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'custom_certhis_enqueue_scripts');


function custom_certhis_enqueue_scripts2()
{
    wp_enqueue_style('certhis-style', 'https://code.certhis.io/beta/theme.css');
    wp_enqueue_script('certhis-script', 'https://code.certhis.io/beta/certhis.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'custom_certhis_enqueue_scripts2');



function custom_certhis_shortcode($atts)
{
    $default_atts = array(
        'collection_index' => '1201',
        'column' => '3',
        'column_mobile' => '2',
        'nft_page' => 'popup',
        'filter_minted' => 'on',
        'google_font' => 'Open Sans',
        'color' => '#000000',
        'color_2' => '#6debf2',
        'filter_search' => 'on',
    );

    $atts = shortcode_atts($default_atts, $atts, 'custom_certhis');


    $random_id = uniqid('certhis_list_nft_');

    ob_start();
?>
    <div id="<?php echo $random_id; ?>" data-filter-search="<?php echo esc_attr($atts['filter_search']); ?>" data-column="<?php echo esc_attr($atts['column']); ?>" data-column-mobile="<?php echo esc_attr($atts['column_mobile']); ?>" data-nft-page="<?php echo esc_attr($atts['nft_page']); ?>" data-filter-minted="<?php echo esc_attr($atts['filter_minted']); ?>" data-collection-index="<?php echo esc_attr($atts['collection_index']); ?>" data-google-font="<?php echo esc_attr($atts['google_font']); ?>" data-color="<?php echo esc_attr($atts['color']); ?>" data-color-2="<?php echo esc_attr($atts['color_2']); ?>">
    </div>
    <script type="text/javascript">
        window.addEventListener("load", function(event) {
            CerthisECN('<?php echo $random_id; ?>');
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('custom_certhis', 'custom_certhis_shortcode');

function custom_certhis_dashboard_menu()
{
    add_menu_page(
        'Custom Certhis Settings', // page title
        'Certhis Marketplace', // menu title
        'manage_options', // capability
        'custom_certhis_settings', // menu slug
        'custom_certhis_render_settings_page', // callback function to render settings page
        'dashicons-grid-view' // icon (you can choose from WordPress Dashicons)
    );
}
add_action('admin_menu', 'custom_certhis_dashboard_menu');


function custom_certhis_render_settings_page()
{

    if (!current_user_can('manage_options')) {
        return;
    }


    if (isset($_POST['certhis_save_settings'])) {
        $settings = array(
            'collection_index' => sanitize_text_field($_POST['certhis_collection_index']),
            'column' => sanitize_text_field($_POST['certhis_column']),
            'column_mobile' => sanitize_text_field($_POST['certhis_column_mobile']),
            'nft_page' => sanitize_text_field($_POST['certhis_nft_page']),
            'custom_url' => sanitize_text_field($_POST['certhis_custom_url']),
            'filter_minted' => isset($_POST['certhis_filter_minted']) ? 'on' : 'off',
            'google_font' => sanitize_text_field($_POST['certhis_google_font']),
            'color' => sanitize_text_field($_POST['certhis_color']),
            'color_2' => sanitize_text_field($_POST['certhis_color_2']),
            'filter_search' => isset($_POST['certhis_filter_search']) ? 'on' : 'off',
        );

        update_option('custom_certhis_settings', $settings);
    }


    $settings = get_option('custom_certhis_settings', array());


?>

    <div class="wrap custom-certhis-form">
        <h1>Settings Certhis Marketplace Shortcode</h1>
        <h2>Here you can generate a shortcode to paste directly onto your wordpress site and display your NFT Marketplace Created On Certhis</h2>
        <form method="post" action="" class="custom-certhis-form">
            <label for="certhis_collection_index">Collection Index:</label>
            <input type="text" id="certhis_collection_index" name="certhis_collection_index" value="<?php echo esc_attr($settings['collection_index']); ?>"><br>

            <label for="certhis_column">Columns (Desktop):</label>
            <select id="certhis_column" name="certhis_column">
                <option value="3" <?php selected($settings['column'], '3'); ?>>3</option>
                <option value="2" <?php selected($settings['column'], '2'); ?>>2</option>
                <option value="1" <?php selected($settings['column'], '1'); ?>>1</option>
            </select><br>

            <label for="certhis_column_mobile">Columns (Mobile):</label>
            <select id="certhis_column_mobile" name="certhis_column_mobile">
                <option value="2" <?php selected($settings['column_mobile'], '2'); ?>>2</option>
                <option value="1" <?php selected($settings['column_mobile'], '1'); ?>>1</option>
            </select><br>

            <label for="certhis_nft_page">NFT Page:</label>
            <select id="certhis_nft_page" name="certhis_nft_page">
                <option value="popup" <?php selected($settings['nft_page'], 'popup'); ?>>Popup</option>
                <option value="Custom URL" <?php selected($settings['nft_page'], 'Custom URL'); ?>>Custom URL</option>
                <option value="certhis" <?php selected($settings['nft_page'], 'certhis'); ?>>URL Certhis</option>
            </select><br>

            <div id="custom-url-wrapper" <?php echo ($settings['nft_page'] === 'Custom URL') ? '' : 'style="display:none"'; ?>>
                <label for="certhis_custom_url">Custom URL:</label>
                <input type="text" id="certhis_custom_url" name="certhis_custom_url" value="<?php echo esc_attr($settings['custom_url']); ?>"><br>
            </div>

            <label for="certhis_filter_minted">Show Mint:</label>
            <input type="checkbox" id="certhis_filter_minted" name="certhis_filter_minted" <?php checked($settings['filter_minted'], 'on'); ?>><br>

            <label for="certhis_google_font">Font Family:</label>
            <select id="certhis_google_font" name="certhis_google_font" class="select2">
                <option value="">Default</option>
                <option value="Arial" <?php selected($settings['google_font'], 'Arial'); ?>>Arial</option>
                <option value="Helvetica" <?php selected($settings['google_font'], 'Helvetica'); ?>>Helvetica</option>
            </select><br>

            <label for="certhis_color">Color:</label>
            <input type="color" id="certhis_color" name="certhis_color" value="<?php echo esc_attr($settings['color']); ?>" class="certhis-color-picker"><br>

            <label for="certhis_color_2">Color 2:</label>
            <input type="color" id="certhis_color_2" name="certhis_color_2" value="<?php echo esc_attr($settings['color_2']); ?>" class="certhis-color-picker"><br>

            <label for="certhis_filter_search">Show Search:</label>
            <input type="checkbox" id="certhis_filter_search" name="certhis_filter_search" <?php checked($settings['filter_search'], 'on'); ?>><br>

            <input type="hidden" name="certhis_save_settings" value="1">
            <label>Generated Shortcode:</label>
            <pre id="generated-shortcode">[custom_certhis collection_index="<?php echo esc_attr($settings['collection_index']); ?>" column="<?php echo esc_attr($settings['column']); ?>" column_mobile="<?php echo esc_attr($settings['column_mobile']); ?>" nft_page="<?php echo ($settings['nft_page'] === 'Custom URL') ? esc_attr($settings['custom_url']) : esc_attr($settings['nft_page']); ?>" filter_minted="<?php echo esc_attr($settings['filter_minted']); ?>" google_font="<?php echo esc_attr($settings['google_font']); ?>" color="<?php echo esc_attr($settings['color']); ?>" color_2="<?php echo esc_attr($settings['color_2']); ?>" filter_search="<?php echo esc_attr($settings['filter_search']); ?>"]</pre>

            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cloudinary-jquery/2.13.0/cloudinary-jquery.min.js" integrity="sha512-da4/9SHI5W0IH1FEZvPM0nEQfVVAzNgCpJ/X7yBfNtbQnwSvGO+XpCK0hByUR4kdgi3Ldwymnr09iOfjD+GyCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        jQuery(document).ready(function($) {


            function updateGeneratedShortcode() {
                var collectionIndex = $('#certhis_collection_index').val();
                var column = $('#certhis_column').val();
                var columnMobile = $('#certhis_column_mobile').val();
                var nftPage = $('#certhis_nft_page').val();
                var customUrl = nftPage === 'Custom URL' ? $('#certhis_custom_url').val() : nftPage;
                var filterMinted = $('#certhis_filter_minted').prop('checked') ? 'on' : 'off';
                var googleFont = $('#certhis_google_font').val();
                var color = $('#certhis_color').val();
                var color2 = $('#certhis_color_2').val();
                var filterSearch = $('#certhis_filter_search').prop('checked') ? 'on' : 'off';

                var shortcode = '[custom_certhis collection_index="' + collectionIndex + '" column="' + column + '" column_mobile="' + columnMobile + '" nft_page="' + customUrl + '" filter_minted="' + filterMinted + '" google_font="' + googleFont + '" color="' + color + '" color_2="' + color2 + '" filter_search="' + filterSearch + '"]';

                $('#generated-shortcode').text(shortcode);
            }


            $('#certhis_nft_page').change(function() {
                if ($(this).val() === 'Custom URL') {
                    $('#custom-url-wrapper').show();
                } else {
                    $('#custom-url-wrapper').hide();
                }
                updateGeneratedShortcode();
            });

            $('#certhis_nft_page').trigger('change');


            $('#certhis_collection_index, #certhis_column, #certhis_column_mobile, #certhis_nft_page, #certhis_custom_url, #certhis_filter_minted, #certhis_google_font, #certhis_color, #certhis_color_2, #certhis_filter_search').on('input change', function() {
                updateGeneratedShortcode();
            });

            $('#certhis_google_font').select2({
                placeholder: 'Select a Google Font',
                ajax: {
                    url: 'https://www.googleapis.com/webfonts/v1/webfonts?key=YOURKEY',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function(data) {
                        var items = [];
                        if (data.items) {
                            data.items.forEach(function(item) {
                                items.push({
                                    id: item.family,
                                    text: item.family,
                                });
                            });
                        }
                        return {
                            results: items,
                        };
                    },
                    cache: true,
                },
            });

        });
    </script>
<?php
}
