<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

/** @var  \PatchTester\View\Pulls\PullsHtmlView  $this */

\JHtml::_('behavior.core');
\JHtml::_('bootstrap.tooltip');
\JHtml::_('stylesheet', 'com_patchtester/octicons.css', array('version' => 'auto', 'relative' => true));
\JHtml::_('script', 'com_patchtester/patchtester.js', array('version' => 'auto', 'relative' => true));

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction', 'desc'));
$filterApplied = $this->escape($this->state->get('filter.applied'));
$filterRtc     = $this->escape($this->state->get('filter.rtc'));
$colSpan       = $this->trackerAlias !== false ? 7 : 6;
?>
<form action="<?php echo \JRoute::_('index.php?option=com_patchtester&view=pulls'); ?>" method="post" name="adminForm" id="adminForm" data-order="<?php echo $listOrder; ?>">
    <div id="j-main-container" class="j-main-container">
        <div class="js-stools clearfix">
            <div class="clearfix">
                <div class="js-stools-container-bar">
                    <label for="filter_search" class="element-invisible"><?php echo \JText::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'); ?></label>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group mr-2">
                            <div class="input-group">
                                <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" placeholder="<?php echo \JText::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'); ?>" />
                                <?php \JHtml::_('bootstrap.tooltip', '#filter_search', array('title' => \JText::_('COM_PATCHTESTER_FILTER_SEARCH_DESCRIPTION'))); ?>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-secondary hasTooltip" title="<?php echo \JHtml::_('tooltipText', 'JSEARCH_FILTER_SUBMIT'); ?>">
                                        <span class="icon-search"></span>
                                    </button>
                                    <button type="button" class="btn btn-secondary hasTooltip js-stools-btn-clear" title="<?php echo \JHtml::_('tooltipText', 'JSEARCH_FILTER_CLEAR'); ?>">
                                        <?php echo \JText::_('JSEARCH_FILTER_CLEAR'); ?>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="js-stools-container-list hidden-md-down">
                    <div class="ordering-select hidden-sm-down">
                        <div class="js-stools-field-list">
                            <label for="sortTable" class="element-invisible"><?php echo \JText::_('JGLOBAL_SORT_BY'); ?></label>
                            <select name="sortTable" id="sortTable" class="custom-select" onchange="PatchTester.orderTable()">
                                <option value=""><?php echo \JText::_('JGLOBAL_SORT_BY'); ?></option>
                                <?php echo \JHtml::_('select.options', $this->getSortFields(), 'value', 'text', $listOrder);?>
                            </select>
                        </div>
                        <div class="js-stools-field-list">
                            <label for="directionTable" class="element-invisible"><?php echo \JText::_('JFIELD_ORDERING_DESC'); ?></label>
                            <select name="directionTable" id="directionTable" class="custom-select" onchange="PatchTester.orderTable()">
                                <option value=""><?php echo \JText::_('JFIELD_ORDERING_DESC');?></option>
                                <option value="asc" <?php if (strtolower($listDirn) == 'asc') echo 'selected="selected"'; ?>><?php echo \JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
                                <option value="desc" <?php if (strtolower($listDirn) == 'desc') echo 'selected="selected"'; ?>><?php echo \JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
                            </select>
                        </div>
                        <div class="js-stools-field-list">
                            <label for="limit" class="element-invisible"><?php echo \JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                            <?php echo $this->pagination->getLimitBox(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filters div -->
            <div class="js-stools-container-filters hidden-sm-down clearfix" style="display: inherit;">
                <div class="js-stools-field-filter">
                    <label for="filter_applied" class="element-invisible"><?php echo \JText::_('JSEARCH_TOOLS_DESC'); ?></label>
                    <select name="filter_applied" class="custom-select" onchange="this.form.submit();">
                        <option value=""><?php echo \JText::_('COM_PATCHTESTER_FILTER_APPLIED_PATCHES'); ?></option>
                        <option value="yes"<?php if ($filterApplied == 'yes') echo ' selected="selected"'; ?>><?php echo \JText::_('COM_PATCHTESTER_APPLIED'); ?></option>
                        <option value="no"<?php if ($filterApplied == 'no') echo ' selected="selected"'; ?>><?php echo \JText::_('COM_PATCHTESTER_NOT_APPLIED'); ?></option>
                    </select>
                </div>
                <div class="js-stools-field-filter">
                    <label for="filter_rtc" class="element-invisible"><?php echo \JText::_('JSEARCH_TOOLS_DESC'); ?></label>
                    <select name="filter_rtc" class="custom-select" onchange="this.form.submit();">
                        <option value=""><?php echo \JText::_('COM_PATCHTESTER_FILTER_RTC_PATCHES'); ?></option>
                        <option value="yes"<?php if ($filterRtc == 'yes') echo ' selected="selected"'; ?>><?php echo \JText::_('COM_PATCHTESTER_RTC'); ?></option>
                        <option value="no"<?php if ($filterRtc == 'no') echo ' selected="selected"'; ?>><?php echo \JText::_('COM_PATCHTESTER_NOT_RTC'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-warning alert-no-items">
                <?php echo \JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
			<table class="table table-striped">
				<thead>
				<tr>
					<th width="5%" class="nowrap text-center">
						<?php echo \JText::_('COM_PATCHTESTER_PULL_ID'); ?>
					</th>
					<th class="nowrap">
						<?php echo \JText::_('JGLOBAL_TITLE'); ?>
					</th>
					<th width="8%" class="nowrap text-center">
						<?php echo \JText::_('COM_PATCHTESTER_READY_TO_COMMIT'); ?>
					</th>
					<th width="8%" class="nowrap text-center">
						<?php echo \JText::_('COM_PATCHTESTER_GITHUB'); ?>
					</th>
					<?php if ($this->trackerAlias !== false) : ?>
					<th width="8%" class="nowrap text-center">
						<?php echo \JText::_('COM_PATCHTESTER_JISSUES'); ?>
					</th>
					<?php endif; ?>
					<th width="10%" class="nowrap text-center">
						<?php echo \JText::_('JSTATUS'); ?>
					</th>
					<th width="15%" class="nowrap text-center">
						<?php echo \JText::_('COM_PATCHTESTER_TEST_THIS_PATCH'); ?>
					</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="<?php echo $colSpan; ?>">
						</td>
					</tr>
				</tfoot>
				<tbody>
				<?php echo $this->loadTemplate('items'); ?>
				</tbody>
			</table>
		<?php endif; ?>

		<?php echo $this->pagination->getListFooter(); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="pull_id" id="pull_id" value="" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo \JHtml::_('form.token'); ?>
	</div>
</form>
