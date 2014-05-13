<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div>
           
            <h2><a href="http://groupdocs.com/">GroupDocs Annotation .NET</a></h2>
            <form action="#" name="form">
                <label for='URL'>URL for GroupDocs Annotation .NET</label>
                <br />
                <input type='text' name='url' value="" />
                <input type='checkbox' id="handler" name='handler'  value="" />Use Http Handler
                <br />
                <label for='name'>Document to annotate (Optional)</label>
                <br>
                <input type="text" name="path" value="">
                <br>
                <label for='name'>User name for annotation assignment (Optional)</label>
                <br>
                <input type="text" name="name" value="">
                <br>
                <label for='width'>Width</label>
                <br>
                <input type="text" name="width" value="650">
                <br>
                <label for="height">Height</label>
                <br>
                <input type="text" name="height" value="500">
                <br>
                <input type="button" name="doRequest" value="Integrate Annotation" onClick="insertAnnotationNet();">
                <input type="button" name="cancel" value="Cancel" onClick="window.close();">
            </form>  
            <br>
            <a target="blank" href="http://groupdocs.com/docs/display/gendoc/FAQs">See our FAQ</a> to learn how to use Annotation for .NET.
        </div>
    </body>
</html>
<script language="JavaScript" type="text/javascript">
   
    function insertAnnotationNet()
    {
        handler = "";
        if (document.getElementById('handler').checked) {
            handler = true;
        } else {
            handler = false;
        }
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange= function() {
           
            if (xhttp.readyState==4 && xhttp.status==200){
                result = eval( '('+xhttp.responseText+')' );
                script = result['result'];
                error = result['error'];
                if (script != "") {
                 
                    var tinyMceContent = window.opener.tinyMCE.activeEditor.getContent();
                                // set content
                    window.opener.tinyMCE.activeEditor.setContent(tinyMceContent + script);
                } else if (error != "") {
                    var tinyMceContent = window.opener.tinyMCE.activeEditor.getContent();
                                // set content
                    window.opener.tinyMCE.activeEditor.setContent(tinyMceContent + error);
                }
                window.close(); 
            }
        }
        form = document.forms.form;
        xhttp.open('POST','edit.php',true);
        xhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        var str='url=' + form.url.value + '&handler=' + handler + '&width=' + form.width.value + 
                 '&height=' + form.height.value + '&path=' + form.path.value + '&name=' + form.name.value;
        xhttp.send(str);
    }
</script>
