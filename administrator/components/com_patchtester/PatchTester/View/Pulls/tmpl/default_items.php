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
		$status = ' class="success"';
	endif;
	?>
	<tr<?php echo $status; ?>>
		<td class="center">
			<?php echo $item->pull_id; ?>
		</td>
		<td>
			<span class="hasTooltip"
				  title="<strong>Info</strong><br/><?php echo $this->escape($item->description); ?>"><?php echo $this->escape($item->title); ?></span>
			<?php if ($item->applied) : ?>
				<div class="small">
					<span class="label label-info"><?php echo Text::sprintf('COM_PATCHTESTER_APPLIED_COMMIT_SHA', substr($item->sha, 0, 10)); ?></span>
				</div>
			<?php endif; ?>
		</td>
		<td class="center hidden-phone">
			<?php echo $this->escape($item->branch); ?>
		</td>
		<td class="center hidden-phone">
			<?php if ($item->is_rtc) : ?>
				<span class="label label-success"><?php echo Text::_('JYES'); ?></span>
			<?php else : ?>
				<span class="label label-primary"><?php echo Text::_('JNO'); ?></span>
			<?php endif; ?>
		</td>
		<td class="center">
			<a class="btn btn-small btn-info" href="<?php echo $item->pull_url; ?>" target="_blank">
				<span class="octicon octicon-mark-github"></span> <?php echo Text::_('COM_PATCHTESTER_GITHUB'); ?>
			</a>
		</td>
		<?php if ($this->trackerAlias !== false) : ?>
			<td class="center">
				<a class="btn btn-small btn-warning"
				   href="https://issues.joomla.org/tracker/<?php echo $this->trackerAlias; ?>/<?php echo $item->pull_id; ?>"
				   target="_blank">
					<i class="icon-joomla"></i> <?php echo Text::_('COM_PATCHTESTER_JISSUE'); ?>
				</a>
			</td>
		<?php endif; ?>
		<td class="center">
			<?php if ($item->applied) : ?>
				<div>
					<span class="label label-success"><?php echo Text::_('COM_PATCHTESTER_APPLIED'); ?></span>
				</div>
			<?php else : ?>
				<span class="label">
			<?php echo Text::_('COM_PATCHTESTER_NOT_APPLIED'); ?>
			</span>
			<?php endif; ?>
		</td>
		<td class="center">
			<?php if ($item->applied) : ?>
				<button type="button" class="btn btn-sm btn-success submitPatch"
						data-task="revert-<?php echo (int) $item->applied; ?>"><?php echo Text::_('COM_PATCHTESTER_REVERT_PATCH'); ?></button>
				<br/>
			<?php else : ?>
				<button type="button" class="btn btn-sm btn-primary submitPatch"
						data-task="apply-<?php echo (int) $item->pull_id; ?>"><?php echo Text::_('COM_PATCHTESTER_APPLY_PATCH'); ?></button>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach;
