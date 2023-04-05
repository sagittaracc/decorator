<?php

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */

/**
 * Данная функция генерирует имя для метода или свойства
 * так чтобы при обращении к нему применялись его декораторы
 * @param string $name
 * @return string
 */
function get_decor_name($name)
{
    return "_$name";
}
/**
 * Данная функция возвращает реальное имя метода или свойства
 * которое должно быть вызвано при обращении к нему по
 * декорированному имени метода или свойства
 * @param string $name
 * @return string
 */
function get_real_name($name)
{
    return ltrim($name, '_');
}