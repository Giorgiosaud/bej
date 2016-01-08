<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
// check if the flexible content field has rows of data
if( have_rows('flexible') ):
	     // loop through the rows of data
	while ( have_rows('flexible') ) : 
		the_row();
	?>
	<div <?php if(get_sub_field('color')){?> style="background-color: <?php the_sub_field('color'); ?>" <?php } ?> >
		<?php
		if( get_row_layout() == 'slider' ):
			show_slider();
		elseif( get_row_layout() == 'section' ): 
			show_section();
		elseif( get_row_layout() == 'parrafo_2_textos_1_imagen' ):
			show_parrafo_2_textos_1_imagen();
		elseif( get_row_layout() == 'parrafo_2_textos' ):
			show_parrafo_2_textos();
		elseif( get_row_layout() == 'parrafo_3_textos_1_imagen_alineados' ):
			show_parrafo_3_textos_1_imagen_alineados();
		elseif( get_row_layout() == 'parrafo_1_texto_centrado' ):
			show_parrafo_1_texto_centrado();
		elseif( get_row_layout()=='1_imagen_centrada'):
			show_1_imagen_centrada();
		elseif( get_row_layout() == 'html' ):
			show_html();
		endif;?>
	</div>
	<?php
	endwhile;

	else :
endif;
?>
