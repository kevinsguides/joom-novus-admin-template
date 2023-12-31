<?php

/**
 * @copyright   (C) 2023 Kevin Olson
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

//get template params preferDesktop
$params = $app->getTemplate(true)->params;
$preferDesktop = $params->get('preferDesktop', 1);


// Set some meta data
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

//check for adminSidebarExpanded cookie
if(!isset($_COOKIE['adminSidebarExpanded'])){
    $adminSidebarExpanded = true;
}else{
    $adminSidebarExpanded = $_COOKIE['adminSidebarExpanded'];
}






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



<body class="admin <?php echo (($preferDesktop) ? 'prefer-desktop' : ''); ?>">
<noscript>
    <div class="alert alert-danger" role="alert">
        <?php echo Text::_('JGLOBAL_WARNJAVASCRIPT'); ?>
    </div>
</noscript>

<jdoc:include type="modules" name="customtop" style="none" />

<?php // Header ?>

<header class="text-white">
    <div class="container">
    <div class="row">
        <div class="col">


    <div class="d-inline"><jdoc:include type="modules" name="title" /></div>
    <a class="link-light text-decoration-none float-end the-site-title" href="<?php //echo the administrator link 
    echo Route::_('index.php'); ?>">
<?php 
    //echo site title
    $title = $app->get('sitename');
    echo $title;
    ?> </a>
</div>
</div>
    <div class="row">
        <div class="header-items d-flex ms-auto" id="status-module">
        <jdoc:include type="modules" name="status" style="none" />
        </div>
    </div>




<?php if (!$hiddenMenu) :?>
<div id="menu">
<jdoc:include type="modules" name="menu" style="none" />
</div>
<?php endif; ?>
</div>

</header>
<a id="sideNavMenuToggleShow" title="Show contextual menu">
<span class="icon-menu"> </span>
</a>
<div id="activeComponentMenuContainer" class="<?php echo (($adminSidebarExpanded) ? 'show' : ''); ?>">
<a id="sideNavMenuToggleCollapse" title="Collapse context menu">
<span class="icon-arrow-left-2"> </span>
</a>

    <ul id="activeComponentMenu">
</ul>
</div>

<div id="toolbar-holder">
<div class="container p-2">
<jdoc:include type="modules" name="toolbar" style="none" />
</div>
</div>

<div id="mainpagearea">
<div class="container mt-3 pt-3">
<main class="card card-body shadow-lg mb-5">
<jdoc:include type="message" />
<jdoc:include type="component" />
</main>

</div>
</div>
<footer id="footer">
    <span>Novus Admin Template by <a href="https://kevinsguides.com" target="_blank">Kevin Olson</a>, <a href="https://kevinsguides.com/tips" target="_blank">Donations</a> &amp; <a href="https://kevinsguides.com/contact" target="_blank">Feedback</a> Appreciated :&#41;</span>
<jdoc:include type="modules" name="footer" style="none" />
<jdoc:include type="modules" name="debug" style="none" />
</footer>
</body>
</html>
