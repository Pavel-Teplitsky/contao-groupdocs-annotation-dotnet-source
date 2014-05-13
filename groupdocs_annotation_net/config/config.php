<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * GroupDocs
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  2012 
 * @author     support@groupdocs.com 
 * @license    GPL 
 */
array_insert($GLOBALS['BE_MOD']['content'], 3, array
(
	'groupdocs_annotation_net' => array
	(
		'tables' => array('tl_gdan'),
		'icon'   => 'system/modules/groupdocs_annotation_net/html/groupdocs.gif'
	)
));
// Just add JS to Back End where using TinyMCE
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array('ArticleAddGroupDocsAnnotationNet', 'javaScriptAnnotationNet');

class ArticleAddGroupDocsAnnotationNet{
    public function javaScriptAnnotationNet($strContent, $strTemplate)
    {
        if ($strTemplate == 'be_main')
        {
            if($_GET['do']=='article' && $_GET['act']=='edit') {
?>
                <script language="JavaScript" >
                        //build GroupDocs Button just above Text Editor
                    setTimeout(function(){
                        place_for_button = document.getElementById('pal_text_legend');
                        legend = place_for_button.getElementsByTagName('legend')[0];
                        button=document.createElement('input');
                        button.type = 'button';
                        button.id = 'groupdocsan';
                        button.value = 'Embed GroupDocs Annotation .NET';
                        button.onclick = function(){ window.open('system/modules/groupdocs_annotation_net/html/form.php', 'GroupDocs Annotation .NET', 'width=450,height=260,resizable=no,scrollbars=no')};
                        insertAfter(legend, button);
                    },500);
                    
                    function insertAfter(referenceNode, newNode) {
                        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                    }
                </script>
<?php
            }
        }
    }
}
?>