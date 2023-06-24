<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.Atum
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       4.0.0
 */

defined('_JEXEC') or die;

use Joomla\CMS\Environment\Browser;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;

/** @var \Joomla\CMS\Document\HtmlDocument $this */

$app   = Factory::getApplication();
$input = $app->getInput();
$wa    = $this->getWebAssetManager();

// Detecting Active Variables
$option = $input->get('option', '');
$view   = $input->get('view', '');
$layout = $input->get('layout', 'default');
$task   = $input->get('task', 'display');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);


$wa->useStyle('template.novus');
// Set some meta data
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$monochrome = (bool) $this->params->get('monochrome');

// Add cookie alert message
Text::script('JGLOBAL_WARNCOOKIES');

// @see administrator/templates/atum/html/layouts/status.php
$statusModules = LayoutHelper::render('status', ['modules' => 'status']);

HTMLHelper::_('bootstrap.dropdown');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body class="admin <?php echo $option . ' view-' . $view . ' layout-' . $layout . ($task ? ' task-' . $task : '') . ($monochrome ? ' monochrome' : ''); ?>">

    <noscript>
        <div class="alert alert-danger" role="alert">
            <?php echo Text::_('JGLOBAL_WARNJAVASCRIPT'); ?>
        </div>
    </noscript>
    <?php if (Browser::getInstance()->getBrowser() === 'msie') : ?>
        <div class="ie11 alert alert-warning" role="alert">
            <?php echo Text::_('JGLOBAL_WARNIE'); ?>
        </div>
    <?php endif; ?>

    <header id="header" class="header d-flex bg-primary">
        <div class="header-title d-flex">
            <div class="d-flex align-items-center">
            </div>
            <jdoc:include type="modules" name="title" />
        </div>
        <?php echo $statusModules; ?>
    </header>

    <div id="wrapper" class="wrapper flex-grow-1" style="background: #c7c7c7;">
        <div class="container-fluid container-main">
            <section id="content" class="content h-100">
                <div class="login_message">
                    <jdoc:include type="message" />
                </div>
                <main class="d-flex justify-content-center align-items-center h-100">
                    <div class="login card card-body">
                        <jdoc:include type="component" />
                    </div>
                </main>
            </section>
        </div>

      
    </div>
    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
