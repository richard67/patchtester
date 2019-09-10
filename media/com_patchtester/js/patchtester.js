/**
 * Patch testing component for the Joomla! CMS
 *
 * @copyright  Copyright (C) 2011 - 2012 Ian MacLennan, Copyright (C) 2013 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later
 */

if (typeof Joomla === 'undefined') {
    throw new Error('PatchTester JavaScript requires the Joomla core JavaScript API')
}

document.addEventListener("DOMContentLoaded", (event) => {

    let submitPatch =   document.querySelectorAll(".submitPatch");
    let pullIdForm  =   document.querySelector("#pull_id");

    /**
     * EventListener which listens on submitPatch Button,
     * checks if it is an apply or revert method and
     * processes the patch action
     *
     * @param {Event} event
     */
    submitPatch.forEach((element) => element.addEventListener("click", (event) => {
        let currentTarget   = event.currentTarget,
            data            = currentTarget.dataset.task.split("-"),
            task            = data[0];

        pullIdForm.value = data[1];
        Joomla.submitform(task);
    }));
});
