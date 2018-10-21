/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
var DOMAIN = 'http://admin.13thknight.com/';
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.skin='office2013',
	config.basicEntities = false,
    config.entities = false,
    config.allowedContent = true,
    config.fillEmptyBlocks = false,
    config.fullPage = false,
    config.enterMode = CKEDITOR.ENTER_BR,
	config.filebrowserBrowseUrl = DOMAIN+'system/libs/ckfinder/ckfinder.html',
	config.filebrowserImageBrowseUrl = DOMAIN+'system/libs/ckfinder/ckfinder.html',
	//config.filebrowserFlashBrowseUrl = DOMAIN+'system/libs/ckfinder/ckfinder.html?type=Flash',
	config.filebrowserUploadUrl = DOMAIN+'system/libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	config.filebrowserImageUploadUrl = DOMAIN+'system/libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
	//config.filebrowserFlashUploadUrl = DOMAIN+'system/libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	
};
