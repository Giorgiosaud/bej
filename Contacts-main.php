<div class="Contactos">
    <div class="formulario"></div>
    <div id="map"></div>
    <div class="formulario">
        <div class="formTitle">Contáctanos</div>
        <form id="formulairoDeContacto" action="" method="POST">
            <input placeholder="Ingrese Su email" class="col s6" type="email" name="email" id="email">
            <input type="nombre" placeholder="Ingrese Su Nombre" class="col s6" name="nombre" id="email">
            <textarea placeholder="Ingrese Su mensaje" name="mensaje" id="mensaje" cols="30" rows="3"></textarea>
            <input type="submit" value="Enviar Contacto">
            <input type="hidden" id="address" value="<?php the_field('address', 'option'); ?>">
        </form>
    </div>
</div>

<div class="alertBox">Mensaje Enviado</div>