<div id="<?php echo $dafen;?>" class="<?php echo $buju;?>">
    <textarea type="text" placeholder="意见反馈" rows="8" name="<?php echo $dafen.'w';?>" autofocus ></textarea><br/> 
    <input type="text" placeholder="热词" name="<?php echo $dafen.'r';?>"/>
    <a class="btn btn-danger" style="padding:6px 9px;" onclick="close_w(<?php echo "'".$dafen."'";?>);">关闭 </a>
    <a class="btn btn-success" style="padding:6px 9px;" onclick="close_w(<?php echo "'".$dafen."'";?>);">提交</a>
</div>
