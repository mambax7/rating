<div id="help-template" class="outer">
    <{include file=$smarty.const._MI_RATING_HELP_HEADER}>

    <h4 class="odd">DESCRIPTION</h4> <br>
    <p>
        In you PHP file:<br><br>
    <pre>
    <strong>XOOPS >= 2.6: ($moduleHelper->getConfig('useRating') == 1)
    XOOPS  < 2.6: XOOPS ($xoopsModuleConfig['useRating'] == 1)

    $content_id : ID your php page</strong>

    <strong>if 'useRating' is defined in your xoopsversion.php</strong><br><br>
    if (($moduleHelper->getConfig('useRating') == 1) and (is_dir('../rating'))){<br><br>
    <strong>or dont use 'useRating', if is not defined in your xoopsversion.php</strong><br><br>
    if ((is_dir('../rating'))){
        require_once XOOPS_ROOT_PATH.'/modules/rating/include/rating.php';
        $xoopsTpl->assign('ratingPerm', true);
        $xoopsTpl->assign('rating', rating($content_id));
    } else {
        $xoopsTpl->assign('ratingPerm', false);
    }
    </pre>
    <br>
    In your template file add this code where you want the rating to appear :<br><br>
    <pre>
    &#139;{if $ratingPerm}&#155;
        &#139;{includefile="module:rating|rating.tpl"}&#155;
    &#139;{/if}&#155;
    </pre>
    </p>

    <p>
        When you're adding in the <strong>"Manage Rating" tab</strong> the modules that implement the Rating, under "Page" add the name of the file that shows the page, e.g. "viewpage.php"
    </p>
