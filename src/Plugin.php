<?php
/**
 * Many to Many Field Type plugin for Craft CMS 3.x
 *
 * A Field Type plugin for Craft 3 that allows the management of relationships from both sides.
 */

namespace OberonAmsterdam\ManyToMany;

use Craft;
use yii\base\Event;
use craft\services\Fields;
use Craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use OberonAmsterdam\ManyToMany\fields\ManyToManyField;
use OberonAmsterdam\ManyToMany\services\ManyToManyService;

/**
 * @property ManyToManyService service
 */
class Plugin extends BasePlugin
{
    public function init()
    {
        parent::init();

        // Register services
        $this->setComponents([
            'service' => ManyToManyService::class,
        ]);

        // Register fields
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = ManyToManyField::class;
            }
        );

        // Log successfully loading plugin
        Craft::info($this->name . ' plugin loaded', __METHOD__);
    }
}
