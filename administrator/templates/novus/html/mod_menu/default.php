<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

$doc       = $app->getDocument();
$class     = $enabled ? 'nav flex-column main-nav' : 'nav flex-column main-nav disabled';

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $doc->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_cpanel');



echo '<nav class="navbar navbar-expand-lg bg-primary">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainAdminMenu" aria-controls="mainAdminMenu" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="mainAdminMenu"> <ul class="navbar-nav me-auto mb-2 mb-lg-0">
';
// Recurse through children of root node if they exist
if ($root->hasChildren()) {

    echo ' <li class="nav-item">';

    // WARNING: Do not use direct 'include' or 'require' as it is important to isolate the scope for each call
    $menu->renderSubmenu(ModuleHelper::getLayoutPath('mod_menu', 'default_submenu'), $root);

    echo "</li>";
}

echo '</ul></div></div></nav>';
