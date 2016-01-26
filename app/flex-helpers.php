<?php
if (! function_exists('show_slider')) :
    function show_slider()
    {
        $id=get_sub_field('id');
        ?>
        <div id="<?php the_sub_field('id') ?>" class="Carousel">
            <div class="Carousel__inner">
                <?php
                $image = get_sub_field('imagen');
                $size='slider';
                ?>
                <div class="Carousel__image">
                    <?= wp_get_attachment_image($image, $size,false,array('class'=>'lazy'));?>
                    <div class="Carousel__caption">
                        <div class="Carousel__description"><?php the_sub_field('descripcion')?></div>
                        <div class="Carousel__owner"><?php the_sub_field('autor')?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }
endif;
if(!function_exists('Show_html')){
    function Show_html(){
        the_sub_field('html');

    }
}
if (! function_exists('show_section')) {
    function show_section()
    {
        ?>
        <section id="<?php the_sub_field('id')?>" class="Section <?php the_sub_field('class')?>">
            <?php
            if (have_rows('article')):
                while (have_rows('article')) : the_row();
                    show_article();
                endwhile;
            endif;
            ?>
        </section>
        <?php
    }
}
if (! function_exists('show_article')) {
    function show_article()
    {?>
        <article id="<?php the_sub_field('id')?>" class="Section__article <?php the_sub_field('class')?>">
            <?php
            if (get_row_layout() == 'html') {
                Show_html();
            }
            ?>
        </article>
        <?php
        // 
    }
}

if(!function_exists('show_parrafo_2_textos_1_imagen')){
    function show_parrafo_2_textos_1_imagen(){
        $imagen='Flex__image';
        $imagecontainer='Flex__imageContainer';
        $textLeft='';
        $textRight='';
        if(get_sub_field('row_or_column')=='Flex--column') {
            $imagen.='--vertical';
            $imagecontainer.='--vertical';
            $textLeft.='Flex--40';
            $textRight.='Flex--40';
        };
    ?>
    <div class="Flex Flex--column" id="<?= get_sub_field('id'); ?>">
        <?php
        if( get_sub_field('titulo')):
        ?>
        <div class="Flex__title"><?= get_sub_field('titulo')?></div>
        <?php
        endif;
        ?>
        <div class="Flex Flex__container <?= get_sub_field('row_or_column')?>">
            <div class="Flex Flex--1 Flex--start <?= $textLeft ?>">
                <?= get_sub_field('texto_izquierdo');?>
            </div>
            <div class="Flex <?=$imagecontainer?>">
                <?= wp_get_attachment_image(get_sub_field('imagen'),'full',false,['class'=>$imagen])?>
            </div>
            <div class="Flex Flex--1 Flex--end <?= $textLeft ?>">
                <?= get_sub_field('texto_derecho');?>
            </div>
        </div>
    </div>
    <?php
    }
}
if(!function_exists('show_1_imagen_centrada')){
    function show_1_imagen_centrada(){
        ?>
        <div class="Flex Flex--column" id="<?= get_sub_field('id')?>">
            <div class="Flex Flex__imageContainer">
                <?= wp_get_attachment_image(get_sub_field('imagen'),'full',false,['class'=>"Flex__image"])?>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('show_parrafo_2_textos')){
    function show_parrafo_2_textos(){
        ?>
        <div class="Flex Flex--column" id="<?= get_sub_field('id')?>" >
            <?php
            if( get_sub_field('titulo')):
                ?>
                <div class="Flex__title"><?= get_sub_field('titulo')?></div>
                <?php
            endif;
            ?>
            <div class="Flex Flex--Space_between Flex__container <?= get_sub_field('row_or_column')?>">
                <div class="Flex--row Flex--40">
                    <?= get_sub_field('texto_izquierdo');?>
                </div>
                <div class="Flex--row Flex--40">
                    <?= get_sub_field('texto_derecho');?>
                </div>
            </div>
        </div>


        <?php
    }
}
if(!function_exists('show_parrafo_3_textos_1_imagen_alineados')){
    function show_parrafo_3_textos_1_imagen_alineados(){
        ?>
        <div class="Flex Flex--column--no-margin--bottom" id="<?= get_sub_field('id')?>">
            <?php
            if( get_sub_field('titulo')):
                ?>
                <div class="Flex__title"><?= get_sub_field('titulo')?></div>
                <?php
            endif;
            ?>
            <div class="Flex Flex__container <?= get_sub_field('row_or_column')?>">
                <div class="Flex Flex--column Flex--1">
                    <div class="Flex__title">
                        <?= get_sub_field('titulo_izquierdo')?>
                    </div>
                    <div class="Flex--row">
                        <?= get_sub_field('texto_izquierdo')?>
                    </div>
                </div>
                <div class="Flex Flex--column Flex--1 Flex--noMobile">
                    <?= wp_get_attachment_image(get_sub_field('imagen'),'full',false,['class'=>"Flex__image"])?>
                </div>
                <div class="Flex Flex--column Flex--1">
                    <div class="Flex__title">
                        <?= get_sub_field('titulo_derecho')?>
                    </div>
                    <div class="Flex--row">
                        <?= get_sub_field('texto_derecho')?>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
}
if(!function_exists('show_parrafo_1_texto_centrado')){
    function show_parrafo_1_texto_centrado(){
        ?>
        <div class="Flex Flex--column--no-margin" id="<?= get_sub_field('id')?>">
            <div class="Flex__title"><?= get_sub_field('titulo')?></div>
            <div class="Flex Flex--30 Flex__container">
                        <?= get_sub_field('descripcion')?>
            </div>
        </div>

        <?php
    }
}

