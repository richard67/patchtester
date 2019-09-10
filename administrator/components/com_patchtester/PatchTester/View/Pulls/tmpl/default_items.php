<?php
/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

use Joomla\CMS\Language\Text;

/** @var \PatchTester\View\DefaultHtmlView $this */

foreach ($this->items as $i => $item) :
	$status = '';

	if ($item->applied) :
		$status = ' class="table-active"';
	endif;
?>
<tr<?php echo $status; ?>>
	<th scope="row" class="text-center">
		<?php echo $item->pull_id; ?>
	</th>
	<td>
		<span><?php echo $this->escape($item->title); ?></span>
		<div role="tooltip" id="tip<?php echo $i; ?>">
			<?php echo $this->escape($item->description); ?>
		</div>
		<div class="row">
			<div class="col-md-auto">
				<a class="badge badge-info" href="<?php echo $item->pull_url; ?>" target="_blank">
					<?php echo Text::_('COM_PATCHTESTER_VIEW_ON_GITHUB'); ?>
				</a>
			</div>
			<div class="col-md-auto">
				<a class="badge badge-info" href="https://issues.joomla.org/tracker/<?php echo $this->trackerAlias; ?>/<?php echo $item->pull_id; ?>" target="_blank">
					<?php echo Text::_('COM_PATCHTESTER_VIEW_ON_JOOMLA_ISSUE_TRACKER'); ?>
				</a>
			</div>
			<?php if ($item->applied) : ?>
				<div class="col-md-auto">
					<span class="badge badge-info"><?php echo Text::sprintf('COM_PATCHTESTER_APPLIED_COMMIT_SHA', substr($item->sha, 0, 10)); ?></span>
				</div>
			<?php endif; ?>
		</div>
	</td>
	<td class="d-none d-md-table-cell text-center">
		<?php echo $this->escape($item->branch); ?>
	</td>
	<td class="d-none d-md-table-cell text-center">
		<?php if ($item->is_rtc) : ?>
			<span class="badge badge-success"><?php echo Text::_('JYES'); ?></span>
		<?php else : ?>
			<span class="badge badge-secondary"><?php echo Text::_('JNO'); ?></span>
		<?php endif; ?>
	</td>
	<td class="text-center">
		<?php if ($item->applied) : ?>
            <span class="badge badge-success"><?php echo Text::_('COM_PATCHTESTER_APPLIED'); ?></span>
		<?php else : ?>
			<span class="badge badge-secondary"><?php echo Text::_('COM_PATCHTESTER_NOT_APPLIED'); ?></span>
		<?php endif; ?>
	</td>
	<td class="text-center">
		<?php if ($item->applied) : ?>
			<button class="btn btn-sm btn-success" onclick="event.stopPropagation(); PatchTester.submitpatch('revert', '<?php echo (int) $item->applied; ?>');"><?php echo Text::_('COM_PATCHTESTER_REVERT_PATCH'); ?></button>
		<?php else : ?>
			<button class="btn btn-sm btn-primary" onclick="event.stopPropagation(); PatchTester.submitpatch('apply', '<?php echo (int) $item->pull_id; ?>');"><?php echo Text::_('COM_PATCHTESTER_APPLY_PATCH'); ?></button>
		<?php endif; ?>
	</td>
</tr>
<?php endforeach;
