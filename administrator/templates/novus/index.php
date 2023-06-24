<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.Atum
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       4.0.0
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var \Joomla\CMS\Document\HtmlDocument $this */

$app   = Factory::getApplication();
$input = $app->getInput();
$wa    = $this->getWebAssetManager();

// Detecting Active Variables
$option       = $input->get('option', '');
$view         = $input->get('view', '');
$layout       = $input->get('layout', 'default');
$task         = $input->get('task', 'display');
$cpanel       = $option === 'com_cpanel' || ($option === 'com_admin' && $view === 'help');
$hiddenMenu   = $app->getInput()->get('hidemainmenu');
$sidebarState = $input->cookie->get('atumSidebarState', '');



// Set some meta data
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');



// @see administrator/templates/atum/html/layouts/status.php
$statusModules = LayoutHelper::render('status', ['modules' => 'status']);

$wa->useStyle('template.novus');
$wa->useScript('template.novus');


//load js collapse
HTMLHelper::_('bootstrap.collapse', '.toggler-burger');
HTMLHelper::_('bootstrap.dropdown', '.toggler-burger');

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>



<body class="admin">
<noscript>
    <div class="alert alert-danger" role="alert">
        <?php echo Text::_('JGLOBAL_WARNJAVASCRIPT'); ?>
    </div>
</noscript>

<jdoc:include type="modules" name="customtop" style="none" />

<?php // Header ?>

<header class="bg-primary text-white">
    <div class="container">
        <div class="header-items d-flex ms-auto" id="status-module">
    <jdoc:include type="modules" name="status" style="none" />
    </div>
<a class="float-start the-site-title link-light text-decoration-none" href="<?php //echo the administrator link 
    echo Route::_('index.php'); ?>">
<?php 
    //echo site title
    $title = $app->get('sitename');
    echo $title;
    ?> : </a>
<jdoc:include type="modules" name="title" />
<?php if (!$hiddenMenu) :?>
<div id="menu">
<jdoc:include type="modules" name="menu" style="none" />
</div>
<?php endif; ?>
</div>

</header>
<div id="toolbar-holder">
<div class="container p-2">
<jdoc:include type="modules" name="toolbar" style="none" />
</div>
</div>

<div class="container mt-3 pt-3">
<main class="card card-body">
<jdoc:include type="message" />
<jdoc:include type="component" />
</main>
</div>

</body>
</html>
