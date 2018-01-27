<?php
echo "<head>\n";
    echo "<meta charset=\"utf-8\">\n";
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
    echo "<link href=\"".RELPATH."styles/mui.min.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
    echo "<link href=\"".RELPATH."styles/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
    echo "<link href=\"".RELPATH."styles/main.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
    echo "<script src=\"".RELPATH."js/jquery-2.1.4.min.js\"></script>\n";
    echo "<script type=\"text/javascript\" charset=\"utf8\" src=\"".RELPATH."js/jquery.dataTables.js\"></script>\n";
    echo "<!--[if lte IE 8]><script language=\"javascript\" type=\"text/javascript\" src=\"".RELPATH."js/excanvas.min.js\"></script><![endif]-->\n";
    echo "<script language=\"javascript\" type=\"text/javascript\" src=\"".RELPATH."js/jquery.flot.js\"></script>\n";
    echo "<script src=\"".RELPATH."js/script.js\"></script>\n";
    echo "<script src=\"".RELPATH."js/mui.min.js\"></script>\n";
    echo "<link rel=\"icon\" sizes=\"16x16\" href=\"".RELPATH."images/favicon.ico\">\n";
    echo "<title>".TITLE."</title>\n";
echo "<script  type=\"text/javascript\">
\$(function(){

    \$('.task_edit').keypress(function(e){
        if(e.which == 13){
            return false;
        }
    });

    \$('.task_edit').focus(function(){
        oldVal = \$(this).text();
        id = \$(this).data('id');
    }).blur(function(){
        newVal = \$(this).text();
            //console.log(oldVal + '|' + newVal + '|' + id);
        if(newVal != oldVal){
            \$.ajax({
                url: '".RELPATH."save.php',
                type: 'POST',
                data: {
                    value: newVal,
                    id: id
                },
                success: function(res){
                    //console.log(res);
                },
                error: function(){
                    alert('Ошибка!')
                }
            });
            console.log(\"Запрос отправлен!\");
        } else{
            //console.log(\"Ничего не изменилось!\");
        }
    });
});
</script>
";

echo "</head>\n";
?>