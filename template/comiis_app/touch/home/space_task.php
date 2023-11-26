<?PHP exit('Access Denied');?>
<!--{template common/header}-->
<div class="comiis_topnv bg_f b_b">
    <ul class="comiis_flex">
        <li class="flex{if $actives[new]} kmon{/if}"><a href="home.php?mod=task&item=new"{if $actives[new]} class="b_0 f_0"{else} class="f_c"{/if}>{lang task_new}</a></li>
        <li class="flex{if $actives[doing]} kmon{/if}"><a href="home.php?mod=task&item=doing"{if $actives[doing]} class="b_0 f_0"{else} class="f_c"{/if}>{$comiis_lang['tip268']}</a></li>
        <li class="flex{if $actives[done]} kmon{/if}"><a href="home.php?mod=task&item=done"{if $actives[done]} class="b_0 f_0"{else} class="f_c"{/if}>{$comiis_lang['tip269']}</a></li>
        <li class="flex{if $actives[failed]} kmon{/if}"><a href="home.php?mod=task&item=failed"{if $actives[failed]} class="b_0 f_0"{else} class="f_c"{/if}>{$comiis_lang['tip270']}</a></li>
    </ul>
</div>
<div class="styli_h10 bg_e b_b"></div>
<!--{if empty($do)}-->
    <!--{subtemplate home/space_task_list}-->
<!--{elseif $do == 'view'}-->
    <!--{subtemplate home/space_task_detail}-->
<!--{/if}-->
<!--{eval $comiis_foot = 'no';}-->
<!--{template common/footer}-->