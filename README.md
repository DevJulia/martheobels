# Marthe Obels Wordpress theme
 
This theme is a child theme of the Storefront theme made by Woocommerce team.

## Mandatory wordpress plugins:
- ACF Pro (I will provide the lifetime licence if needed)
- WooCommerce
- Storefront theme

## Development
1) In `scripts.php` and `styles.php` files, make sure to register scripts/styles from `assets/build` folder
2) Include browser sync script to enable hot reloading (currently in `storefront_hooks.php` file)
3) Run `npm run watch`

### How to
Avoid as much as possible to override Woocommerce/Storefront template. Use hooks and filters instead (in `storefront_hooks.php` and `woocommerce.php`).

## Deployment
1) In `scripts.php` and `styles.php` files, make sure to register scripts/styles from `dist` folder
2) Remove browser sync script for hot reloading (currently in `storefront_hooks.php` file)
3) Run `npm run build`

## What's left to do
- Potential feedbacks from designer/client
- Homepage fixes and feedbacks: the homepage uses `Sly.js` plugin but it has some issue with Mac's trackpad. There's also a bug when clicking on the navbar, it should navigate to the correct section.
- Responsive header and footer
- Woocommerce configuration: add and configure required plugins and style the widgets if needed
- Write or organize a training session with the client to help her use the backoffice
