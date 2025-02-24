<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DebugBar\DataCollector;

/**
 * Collects info about the current localization state
 */
class LocalizationCollector extends DataCollector implements Renderable
{
    /**
     * Get the current locale
     *
     * @return string
     */
    #[\ReturnTypeWillChange] public function getLocale()
    {
        return setlocale(LC_ALL, 0);
    }

    /**
     * Get the current translations domain
     *
     * @return string
     */
    #[\ReturnTypeWillChange] public function getDomain()
    {
        return textdomain();
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange] public function collect()
    {
        return array(
          'locale' => $this->getLocale(),
          'domain' => $this->getDomain(),
        );
    }

    /**
     * @return string
     */
    #[\ReturnTypeWillChange] public function getName()
    {
        return 'localization';
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange] public function getWidgets()
    {
        return array(
            'domain' => array(
                'icon' => 'bookmark',
                'map'  => 'localization.domain',
            ),
            'locale' => array(
                'icon' => 'flag',
                'map'  => 'localization.locale',
            )
        );
    }
}
