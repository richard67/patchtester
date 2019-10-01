/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

if (typeof Joomla === 'undefined') {
    throw new Error('PatchTester JavaScript requires the Joomla core JavaScript API')
}

document.addEventListener("DOMContentLoaded", function (event) {

    var submitPatch = document.querySelectorAll(".submitPatch");
    var pullIdForm  = document.querySelector("#pull_id");

    /**
     * EventListener which listens on submitPatch Button,
     * checks if it is an apply or revert method and
     * processes the patch action
     *
     * @param {Event} event
     */
    submitPatch.forEach(function (element) {
        element.addEventListener("click", function (event) {
            var currentTarget = event.currentTarget;
            var data          = currentTarget.dataset.task.split("-");

            pullIdForm.value = data[1];
            Joomla.submitform(data[0]);
        });
    });
});
