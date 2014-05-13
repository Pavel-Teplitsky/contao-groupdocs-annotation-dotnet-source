<?php

$groupdocs_url = $_POST['url'];
$handler = $_POST['handler'];
$width = $_POST['width'];
$height = $_POST['height'];
$path = $_POST['path'];
$usehandler = null;
$userName = $_POST['name'];
if (!empty($groupdocs_url)) {
    if ($width == 0) {
        $width = "650";
    }
    if ($height == 0) {
        $height = "500";
    }
    if ($handler == true) {
        $handler = "Handler";
        $use = true;
        $ajaxPath = $groupdocs_url . "/ajax.ashx/" . $userName;
        $postData = "";
    } else {
        $handler = "";
        $use = false;
        $ajaxPath = $groupdocs_url . "/home/getId/";
        $postData = "un=" . $userName;
    }
    if (substr($groupdocs_url, -1) == '/') {
        $groupdocs_url = substr_replace($groupdocs_url, "", -1);
    }
    $url = $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/jquery-ui-1.10.3.min.js";
    $headers = get_headers($url, 1);
    if ($headers[0] == 'HTTP/1.1 200 OK') {
        $content = '';
        //Remove spaces and tags from document name for view and annotate
        $name = trim(strip_tags($name));
        $script = "<div id='GD Annotation'>GroupDocs Annotation for .NET<script src='" . $groupdocs_url . "/Scripts/jquery-1.10.2.min.js' type='text/javascript'></script>
                <script src='" . $groupdocs_url . "/Scripts/jquery-ui-1.10.3.min.js' type='text/javascript'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/jquery-1.9.1.min.js'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/jquery-ui-1.10.3.min.js'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/knockout-3.0.0.js'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/turn.min.js'></script>"
                . "<script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/modernizr.2.6.2.Transform2d.min.js'></script>"
                . "<script type='text/javascript'>if (!window.Modernizr.csstransforms)   $.ajax({url: '" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=libs/turn.html4.min.js', "
                . "dataType: 'script', type: 'GET', async: false});</script>"
                . "<script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=installableViewer.min.js'></script>"
                . "<script type='text/javascript'>$.ui.groupdocsViewer.prototype.applicationPath = '" . $groupdocs_url . "/';</script>"
                . "<script type='text/javascript'>$.ui.groupdocsViewer.prototype.useHttpHandlers = " . $use . ";</script>"
                . "<script type='text/javascript' src='" . $groupdocs_url . "/document-viewer/GetScript" . $handler . "?name=GroupdocsViewer.all.min.js'></script>"
                . "<div style='display:none'>// <![CDATA["
                . "<p>"
                . "<link rel='stylesheet' type='text/css' href='" . $groupdocs_url . "/document-viewer/CSS/GetCss" . $handler . "?name=bootstrap.css' />"
                . "<link rel='stylesheet' type='text/css' href='" . $groupdocs_url . "/document-viewer/CSS/GetCss" . $handler . "?name=GroupdocsViewer.all.min.css' />"
                . "<link rel='stylesheet' type='text/css' href='" . $groupdocs_url . "/document-viewer/CSS/GetCss" . $handler . "?name=jquery-ui-1.10.3.dialog.min.css' />
                // ]]></div>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-annotation/GetScript" . $handler . "?name=libs/jquery.signalR-1.1.2.min.js'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-annotation/GetScript" . $handler . "?name=libs/jquery.tinyscrollbar.min.js'></script>
                <script type='text/javascript' src='" . $groupdocs_url . "/document-annotation/GetScript" . $handler . "?name=GroupdocsAnnotation.all.min.js'></script>
                <div style='display:none'>// <![CDATA[
                <p>
                <link rel='stylesheet' type='text/css' href='" . $groupdocs_url . "/document-annotation/CSS/GetCss" . $handler . "?name=Annotation.css' />
                <link rel='stylesheet' type='text/css' href='" . $groupdocs_url . "/document-annotation/CSS/GetCss" . $handler . "?name=Toolbox.css' />
                // ]]></div>                            
                <script type='text/javascript' src='" . $groupdocs_url . "/signalr1_1_2/hubs'></script>
                <script type='text/javascript'>
                        var userName = '" . $userName . "';
                        //Send ajax request to set entered user as collaborator for document
                        $.ajax({
                            type: 'POST',
                            url: '" . $ajaxPath . "',
                            data: '" . $postData . "',
                            cache: false,
                            async: true,
                            success: function (userInfo){
                                var userId = '';
                                if (typeof userInfo === 'object') {
                                    userId = userInfo[0];
                                } else {
                                    userId = userInfo
                                }
                                //All settings for integrated Annotation
                                var annotationWidget = $('#annotation-widget').groupdocsAnnotation({
                                    width: " . $width . ",
                                    height: " . $height . ",
                                    fileId: '" . $path . "',
                                    docViewerId: 'annotation-widget-doc-viewer',
                                    quality: 90,
                                    enableRightClickMenu: false,
                                    showHeader: false,
                                    showZoom: true,
                                    showPaging: true,
                                    showPrint: false,
                                    showFileExplorer: true,
                                    showThumbnails: true,
                                    openThumbnails: false,
                                    zoomToFitWidth: false,
                                    zoomToFitHeight: false,
                                    initialZoom: 100,
                                    preloadPagesCount: 0,
                                    sideboarContainerSelector: 'div.comments_sidebar_wrapper',
                                    usePageNumberInUrlHash: false,
                                    textSelectionSynchronousCalculation: true,
                                    variableHeightPageSupport: true,
                                    useJavaScriptDocumentDescription: true,
                                    isRightPanelEnabled: true,
                                    createMarkup: true,
                                    use_pdf: 'true',
                                    _mode: 'annotatedDocument',
                                    selectionContainerSelector: \"[name='selection-content']\",
                                    graphicsContainerSelector: '.annotationsContainer',
                                    userName: userName,
                                    userId: userId,
                                    enabledTools: -1,
                                    enableSidePanel: true
                                });
                                var annotationsViewer = $(annotationWidget).groupdocsAnnotation('getViewer');
                                var annotationsViewerVM = $(annotationsViewer).groupdocsAnnotationViewer('getViewModel');
                                var commentModePanel = $(annotationWidget).find('div.embed_annotation_tools');
                                commentModePanel.css('margin-right', 0);
                                commentModePanel.draggable({
                                    scroll: false,
                                    handle: '.tools_dots',
                                    containment: 'body',
                                    appendTo: 'body'
                                });
                                $(annotationWidget).find('.tool_field').click(function () {
                                    var toolFields = $(annotationWidget).find('.tool_field');
                                    if (toolFields.hasClass('active')) {
                                        $(toolFields.removeClass('active'));
                                    };
                                    $(this).addClass('active');
                                });
                                $(annotationWidget).find('.header_tools_icon').hover(

                                    function () {
                                        $(this).find('.tooltip_on_hover').css('display', 'block');
                                    },

                                    function () {
                                        $(this).find('.tooltip_on_hover').css('display', 'none');
                                });

                                $('#annotation-widget .comments_togle_btn').click(function () { flipPanels(true); });
                                $(annotationWidget).find('.comments_scroll').tinyscrollbar({ sizethumb: 50 });
                                $(annotationWidget).find('.comments_scroll_2').tinyscrollbar({ sizethumb: 50 });
                                var annotationIconsWrapper = $(annotationWidget).find('.annotation_icons_wrapper');
                                var annotationIconsWrapperParent = annotationIconsWrapper.parent()[0];
                                var annotationIconsWrapperParentScrollTop;
                                annotationsViewer.bind('onDocumentLoadComplete', function (e, data) {
                                    annotationsViewerVM.listAnnotations();
                                    annotationsViewerVM.setHandToolMode();
                                    annotationIconsWrapper.height($(annotationsViewer).find('.pages_container').height());
                                    annotationIconsWrapperParent.scrollTop = annotationIconsWrapperParentScrollTop;
                                });
                                annotationsViewer.bind('onDocViewScrollPositionSet', function (e, data) {
                                    annotationIconsWrapper.parent()[0].scrollTop = data.position;
                                }.bind(this));
                                annotationsViewer.bind('onBeforeScrollDocView onDocViewScrollPositionSet', function (e, data) {
                                    if (annotationIconsWrapperParent.scrollTop != data.position) {
                                        annotationIconsWrapperParent.scrollTop = data.position;
                                        annotationIconsWrapperParentScrollTop = data.position;
                                    }
                                }.bind(this))

                                function flipPanels(togglePanels) {
                                    var docViewer = $(annotationsViewer)[0];
                                    var annotationIconsPanelVisible = $(annotationWidget).find('.comments_sidebar_collapsed').is(':visible');
                                    function setIconsPanelScrollTop() {
                                        if (!annotationIconsPanelVisible)
                                        annotationIconsWrapperParent.scrollTop = docViewer.scrollTop;
                                    }

                                    function redrawLinesAndCalculateZoom() {
                                    setIconsPanelScrollTop();
                                        if (togglePanels) {
                                            annotationsViewerVM.redrawConnectingLines(!annotationIconsPanelVisible);
                                        } else {
                                        annotationsViewerVM.resizePagesToWindowSize();
                                            var selectableElement = annotationsViewerVM.getSelectable();
                                            if (selectableElement != null) {
                                                var selectable = (selectableElement.data('ui-dvselectable') || selectableElement.data('dvselectable'));
                                                selectable.initStorage();
                                            }

                                        annotationsViewerVM.redrawWorkingArea();
                                        }
                                    }

                                    if (togglePanels) {
                                        if (!annotationIconsPanelVisible) {
                                            redrawLinesAndCalculateZoom();
                                        };
                                        var setIntervalId = window.setInterval(function () {
                                            setIconsPanelScrollTop();
                                        }, 50);
                                        $(annotationWidget).find('.comments_sidebar_collapsed').toggle('slide', { direction: 'right' }, 400, function () {
                                            clearInterval(setIntervalId);
                                            setIconsPanelScrollTop();
                                        });
                                        $(annotationWidget).find('.comments_sidebar_expanded').toggle('slide', { direction: 'right' }, 400,

                                        function () {
                                            if (annotationIconsPanelVisible)
                                                redrawLinesAndCalculateZoom();
                                            else
                                                setIconsPanelScrollTop();
                                                //window.setZoomWhenTogglePanel();
                                            })

                                    } else {
                                        redrawLinesAndCalculateZoom();
                                        $(annotationWidget).find('.comments_scroll').tinyscrollbar_update('relative');
                                        $(annotationWidget).find('.comments_scroll_2').tinyscrollbar_update('relative');
                                    }
                                }

                                $(window).resize(function () {
                                    flipPanels(false);
                                    resizeSidebar();
                                });
                                resizeSidebar();

                                function resizeSidebar() {
                                    var containerHeight = $('#annotation-widget .doc_viewer').height();
                                    $(annotationWidget).find('.comments_content').css({ 'height': (containerHeight - 152) + 'px' });
                                    $(annotationWidget).find('.comments_scroll').css({ 'height': (containerHeight - 152) + 'px' });
                                    $(annotationWidget).find('.comments_scroll .viewport').css({ 'height': (containerHeight - 172) + 'px' });
                                    $(annotationWidget).find('.comments_sidebar_collapsed').css({ 'height': (containerHeight - 50) + 'px' });
                                    $(annotationWidget).find('.comments_scroll').tinyscrollbar_update('relative');
                                    $(annotationWidget).find('.comments_scroll_2').css({ 'height': (containerHeight - 152) + 'px' });
                                    $(annotationWidget).find('.comments_scroll_2 .viewport').css({ 'height': (containerHeight - 152) + 'px' });
                                    $(annotationWidget).find('.comments_scroll_2').tinyscrollbar_update('relative');
                                }

                                $('html').click(function () {
                                    if ($(annotationWidget).find('.dropdown_menu_button').hasClass('active')) {
                                        $(annotationWidget).find('.dropdown_menu_button.active').next('.dropdown_menu').hide('blind', 'fast');
                                        $(annotationWidget).find('.dropdown_menu_button.active').removeClass('active');
                                    }
                                })

                            }

                        });
                    </script>
                    <div id='annotation-widget' class='groupdocs_viewer_wrapper grpdx' style='width:" . $width . "px;height:" . $height . "px;'>" . $content . "</div></div>";
    } else {
        $content = "Please change \"Use HTTP Handlers\" option in edit block form";
        $script = "<div id='annotationdotnet' style='width:" . $width . "px;height:" . $height . "px;overflow:hidden;position:relative;margin-bottom:20px;background-color:gray;border:1px solid #ccc;'>" . $content . "</div>";
    }
}
$result = array("result" => $script);
echo json_encode($result);
?>