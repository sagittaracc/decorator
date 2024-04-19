<?php

namespace Sagittaracc\PhpPythonDecorator\modules;

use Sagittaracc\PhpPythonDecorator\exceptions\ModuleError;

/**
 * Модуль
 * Назначение модулей - внедряться в объекты которые используют декораторы
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
class Module
{
    const NOT_FOUND = 400;

    /**
     * Абсолютно любой объект который использует декораторы
     * В данный объект внедряются пользовательские модули
     * @var object
     */
    protected object $object;
    /**
     * Проверяет может ли модуль внедриться в объект
     * Для этого объект должен использовать декораторы
     * Поэтому у объекта должно быть проперти scope
     * @return boolean
     */
    private function canImplement()
    {
        return isset($this->object?->scope['modules']);
    }
    /**
     * Проверяет имплементирован ли уже модуль в объект
     * @return boolean
     */
    private function hasInstance()
    {
        return isset($this->object->scope['modules'][static::class]);
    }
    /**
     * Получает экземпляр модуля из объекта внедрения
     * @return static
     */
    private function getInstance()
    {
        return $this->object->scope['modules'][static::class]['instance'];
    }
    /**
     * Внедряет модуль в объект внедрения
     * @return static
     */
    private function setInstance()
    {
        $this->object->scope['modules'][static::class]['instance'] = $this;

        return $this;
    }
    /**
     * Получает экземпляр модуля из объекта внедрения
     * @param object $object объект внедрения
     * @return static
     */
    public static function getInstanceFrom(object $object)
    {
        $module = new static;
        $module->object = $object;

        if (!$module->canImplement()) {
            throw new ModuleError('', self::NOT_FOUND); // TODO: Придумать текст исключения
        }

        if (!$module->hasInstance()) {
            $module->setInstance();
        }

        return $module->getInstance();
    }
}