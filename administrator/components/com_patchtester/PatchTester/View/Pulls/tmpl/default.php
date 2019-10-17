<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var  \PatchTester\View\Pulls\PullsHtmlView $this */

HTMLHelper::_('behavior.core');
HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('stylesheet', 'com_patchtester/octicons.css', array('version' => '3.5.0', 'relative' => true));
HTMLHelper::_('script', 'com_patchtester/patchtester.js', array('version' => 'auto', 'relative' => true));

$listOrder = $this->escape($this->state->get('list.fullordering', 'a.pull_id DESC'));
$filterApplied = $this->escape($this->state->get('filter.applied'));
$filterBranch = $this->escape($this->state->get('filter.branch'));
$filterRtc = $this->escape($this->state->get('filter.rtc'));
?>
<form action="<?php echo Route::_('index.php?option=com_patchtester&view=pulls'); ?>" method="post" name="adminForm"
	  id="adminForm" data-order="<?php echo $listOrder; ?>">
	<div id="j-main-container">
		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search"
					   class="element-invisible"><?php echo Text::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'); ?></label>
				<input type="text" name="filter_search"
					   placeholder="<?php echo Text::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'); ?>"
					   id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
					   title="<?php echo Text::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'); ?>"/>
			</div>
			<div class="btn-group pull-left hidden-phone">
				<button class="btn tip hasTooltip" type="submit"
						title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
				<button class="btn tip hasTooltip" type="button"
						onclick="document.getElementById('filter_search').value='';this.form.submit();"
						title="<?php echo Text::_('JSEARCH_FILTER_CLEAR'); ?>"><i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit"
					   class="element-invisible"><?php echo Text::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right">
				<label for="list_fullordering"
					   class="element-invisible"><?php echo Text::_('JGLOBAL_SORT_BY'); ?></label>
				<select name="list_fullordering" id="list_fullordering" class="input-medium"
						onchange="this.form.submit();">
					<option value=""><?php echo Text::_('JGLOBAL_SORT_BY'); ?></option>
					<?php echo HTMLHelper::_('select.options', $this->getSortFields(), 'value', 'text', $listOrder); ?>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="filter_applied"
					   class="element-invisible"><?php echo Text::_('JSEARCH_TOOLS_DESC'); ?></label>
				<select name="filter_applied" class="input-medium" onchange="this.form.submit();">
					<option value=""><?php echo Text::_('COM_PATCHTESTER_FILTER_APPLIED_PATCHES'); ?></option>
					<option value="yes"<?php if ($filterApplied == 'yes') echo ' selected="selected"'; ?>><?php echo Text::_('COM_PATCHTESTER_APPLIED'); ?></option>
					<option value="no"<?php if ($filterApplied == 'no') echo ' selected="selected"'; ?>><?php echo Text::_('COM_PATCHTESTER_NOT_APPLIED'); ?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="filter_rtc" class="element-invisible"><?php echo Text::_('JSEARCH_TOOLS_DESC'); ?></label>
				<select name="filter_rtc" class="input-medium" onchange="this.form.submit();">
					<option value=""><?php echo Text::_('COM_PATCHTESTER_FILTER_RTC_PATCHES'); ?></option>
					<option value="yes"<?php if ($filterRtc == 'yes') echo ' selected="selected"'; ?>><?php echo Text::_('COM_PATCHTESTER_RTC'); ?></option>
					<option value="no"<?php if ($filterRtc == 'no') echo ' selected="selected"'; ?>><?php echo Text::_('COM_PATCHTESTER_NOT_RTC'); ?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="filter_branch"
					   class="element-invisible"><?php echo Text::_('JSEARCH_TOOLS_DESC'); ?></label>
				<select name="filter_branch" class="input-medium" onchange="this.form.submit();">
					<option value=""><?php echo Text::_('COM_PATCHTESTER_FILTER_BRANCH'); ?></option>
					<?php echo HTMLHelper::_('select.options', $this->branches, 'text', 'text', $filterBranch, false); ?>
				</select>
			</div>
		</div>

		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped">
				<thead>
				<tr>
					<th width="5%" class="nowrap center">
						<?php echo Text::_('COM_PATCHTESTER_PULL_ID'); ?>
					</th>
					<th class="nowrap">
						<?php echo Text::_('JGLOBAL_TITLE'); ?>
					</th>
					<th width="8%" class="nowrap center hidden-phone">
						<?php echo Text::_('COM_PATCHTESTER_BRANCH'); ?>
					</th>
					<th width="8%" class="nowrap center hidden-phone">
						<?php echo Text::_('COM_PATCHTESTER_READY_TO_COMMIT'); ?>
					</th>
					<th width="8%" class="nowrap center">
						<?php echo Text::_('COM_PATCHTESTER_GITHUB'); ?>
					</th>
					<?php if ($this->trackerAlias !== false) : ?>
						<th width="8%" class="nowrap center">
							<?php echo Text::_('COM_PATCHTESTER_JISSUES'); ?>
						</th>
					<?php endif; ?>
					<th width="10%" class="nowrap center">
						<?php echo Text::_('JSTATUS'); ?>
					</th>
					<th width="15%" class="nowrap center">
						<?php echo Text::_('COM_PATCHTESTER_TEST_THIS_PATCH'); ?>
					</th>
				</tr>
				</thead>
				<tbody>
				<?php echo $this->loadTemplate('items'); ?>
				</tbody>
			</table>
		<?php endif; ?>

		<?php echo $this->pagination->getListFooter(); ?>

		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<input type="hidden" name="pull_id" id="pull_id" value=""/>
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>
