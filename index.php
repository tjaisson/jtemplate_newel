<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

//if ($this->params->get('googleFont'))
// $doc->addStyleSheet('http://fonts.googleapis.com/css?family='.$this->params->get('googleFontName'));


// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
$rspanw = 3;  //largeur colonne droite -> transformer en param de template
$lspanw = 3;  //largeur colonne gauche 

$rspan = 'span' . $rspanw;
$lspan = 'span' . $lspanw;

$spanw = 12 - ($this->countModules('position-7')>0?$rspanw:0) - ($this->countModules('position-8')>0?$lspanw:0) ;
$span = 'span' . $spanw;

// Logo file or site title param

if ($logoFile = $this->params->get('logoFile'))
{
	$logoSize   = getimagesize(JPATH_BASE . '/' . $logoFile);
	$logo = '<img src="'. JUri::root() . $logoFile .'" alt="'. $sitename .'" title="'. $sitename .'" height="' . $logoSize[1] . '" width="' . $logoSize[0] .'" />';
}
else
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($sitename) .'</span>';
}

if ($logoFile = $this->params->get('logoFileSmall'))
{
	$logoSize   = getimagesize(JPATH_BASE . '/' . $logoFile);
	$logoSmall = '<img src="'. JUri::root() . $logoFile .'" alt="'. $sitename .'" title="'. $sitename .'" height="' . $logoSize[1] . '" width="' . $logoSize[0] .'" />';
}
else
{
	$logoSmall = '';
}
$logoSmall .= '<span title="'. $sitename .'">'. htmlspecialchars($sitename) .'</span>';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
  <style type="text/css">
   header.header
   {
   }
   header.header:hover
   {
   }
   a
   {
    color: <?php echo $this->params->get('templateColor');?>;
   }
   .navbar-inner,
   .nav-list > .active > a,
   .nav-list > .active > a:hover,
   .dropdown-menu li > a:hover,
   .dropdown-menu .active > a,
   .dropdown-menu .active > a:hover,
   .nav-pill > .active > a,
   .nav-pill > .active > a:hover,
   .btn-primary
   {
    background: <?php echo $this->params->get('templateColor');?>;
   }
   .navbar-inner
   {
    -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
    box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
   }
  </style>
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($this->params->get('fluidContainer') ? ' fluid' : '');
?>">

<jdoc:include type="modules" name="hidden" style="hidden" />

	<!-- Body -->
	<div class="body" id="top">
	<!--[if !IE]><!-->
		<div class="container<?php echo ($this->params->get('fluidContainer') ? '-fluid' : '');?>">
	<!--<![endif]-->
	<!--[if IE]>
		<div class="container">
	<![endif]-->
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<div class="row-fluid">
						<div class="span3 hidden-phone">
                        	<a class="brand" href="<?php echo $this->baseurl; ?>">
							<?php echo $logo; ?>
                            </a>
						</div>
						<div class="span9 pull-right">
							<?php if ($this->countModules('position-1')) : ?>
							<nav class="navbar navigation" role="navigation">
									<div class="container-fluid">
										<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										</a>
                                        <a class="visible-phone pull-left" href="<?php echo $this->baseurl; ?>">
                                        <?php echo $logoSmall; ?>
                                        </a>
                                    <div class="nav-collapse">
                                        <jdoc:include type="modules" name="position-1" style="none" />
                                    </div>
                                    </div>
							</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</header>
			<jdoc:include type="modules" name="banner" style="xhtml" />
	<!--[if !IE]><!-->
			<div class="row-fluid">
	<!--<![endif]-->
	<!--[if IE]>
			<div class="row">
	<![endif]-->
				<?php if ($this->countModules('position-8')) : ?>
				<!-- Begin Sidebar -->
				<div id="sidebar" class="<?php echo $lspan;?>">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="none" />
					</div>
				</div>
				<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span;?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="<?php echo $rspan;?>">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($this->params->get('fluidContainer') ? '-fluid' : '');?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right"><a href="#top" id="back-top"><?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?></a></p>
			<p>&copy; <?php echo $sitename.' '.date('Y');?></p>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-10967916-1', 'elisa-lemonnier.fr');
  ga('send', 'pageview');

</script>
	
</body>
</html>
