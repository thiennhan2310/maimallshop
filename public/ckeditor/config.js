/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'links'},
        {name: 'insert'},
        {name: 'forms'},
        {name: 'tools'},
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'others'},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'styles'},
        {name: 'colors'},
        {name: 'about'}
    ];

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';
    //Add font toolbar
    config.extraPlugins = 'font';
    // Simplify the dialog windows.
    config.skin = 'office2013';
	var root="http://localhost/maimallshop/public/kcfinder";
    config.resize_minWidth = 450;
    config.filebrowserBrowseUrl = root + '/browse.php?type=files&lang=vi';
    config.filebrowserImageBrowseUrl = root+ '/browse.php?type=images&lang=vi';
    config.filebrowserFlashBrowseUrl = root+'/browse.php?type=flash&lang=vi';
    config.filebrowserUploadUrl = root+'/upload.php?type=files&lang=vi';
    config.filebrowserImageUploadUrl = root+'/upload.php?type=images&lang=vi';
    config.filebrowserFlashUploadUrl = root+ '/upload.php?type=flash&lang=vi';
};
