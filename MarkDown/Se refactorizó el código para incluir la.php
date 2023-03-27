Se refactorizó el código para incluir las etiquetas de inicio y cierre de HTML en vez de usar echo para cada línea.
También se usaron las comillas dobles para poder interpolar las variables de manera más fácil y legible.

```php
<?php
for ($i = 1; $i <= 3; $i++) {
    ?>
    <div class="container">
        <?php tarjetas($i); ?>
        <div class="pagination">
            <button id="prev-btn-<?php echo $i; ?>">🔙</button>
            <button id="next-btn-<?php echo $i; ?>">🔜</button>
        </div>
    </div>
    <?php
}
?>
```

Se utilizó la sintaxis del código incrustado de PHP ```
<?php ?>``` y la sintáxis alternativa del etiquetado de bloques de PHP ```
<?php ?>``` para separar el HTML de la lógica del programa, haciéndolo más fácil de leer y mantener.