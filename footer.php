<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<footer>
<?php the_field('footer-text', 'option'); ?>
</footer>
<div class="footer-band"></div>
<?php wp_footer(); ?>
</div>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAVEC8MNGaMrBDUEpdO_KJirXnNv3OkeY&callback=initMap">
</script>
</body>
</html>