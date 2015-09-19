<?php include 'config.php'; ?>
<?php include 'db.php'; ?>
<style>
    .panel-tool-close
    {
        display:none !important;
    } 
</style>
<body>    
    <?php
    if ($_POST['upd'] == 'upd')
    {
        $text = 'Обновить';
        $parent = $_POST['parent'];
    }
    elseif (($_POST['upd'] == 'add'))
    {
        $parent = $_POST['id'];
        $prnt = $_POST['parent'];
        $_POST['name'] = null;
        $_POST['link'] = null;
        $_POST['order'] = null;
        $_POST['name'] = null;
        $text = 'Добавить';

        $result = $db->query("SELECT 
                                coalesce(max(f_order) + 1 , 1) as max
                              FROM 
                                page
                                where parent_id =$prnt");
        while ($row = $result->fetchArray())
        {

            $_POST['order'] = $row['max'];
        }
    }
    elseif (($_POST['upd'] == 'del'))
    {
        $text = 'Удалить';
        $parent = $_POST['parent'];
    }
    ?>
    <div id="dlg" class="easyui-dialog" title="<?php echo $text; ?>" style="width:400px;height:200px;padding:10px"
         data-options="
         closed: false,         
         buttons: [{
         text:'Применить',
         iconCls:'icon-ok',
         handler:function(){
         eatFood();
         }
         },{
         text:'Отмена',
         handler:function(){
         window.location.href=window.location.href;
         }}
         ]
         "> 
             <?php
             $result = $db->query("SELECT 
                                    title
                                  FROM 
                                    page
                                    where id =$parent");
             while ($row = $result->fetchArray())
             {

                 $parent_name = $row['title'];
             }
             ?>
        <form action="" method="post" name="form_name" id="form_id" class="form_class" >
            <input name="type" id="type" type='hidden' value="<?php echo $_POST['upd'] ?>" />
            <input name="id" id="id" type='hidden' value="<?php echo $_POST['id'] ?>" />
            <label>Имя</label><input type="text" name="name" id="name" placeholder="name" value="<?php echo $_POST['name'] ?>"/>
            <br/>
            <label>Ссылка</label><input type="text" size="35" name="link" id="link" placeholder="link" value="<?php echo $_POST['link'] ?>"/>
            <br/><label>Предок</label><input type="text" name="parent" id="parent" placeholder="parent" value="<?php echo $parent_name ?>" readonly/>
            <input name="parent_id" id="parent_id" type='hidden' value="<?php echo $_POST['parent'] ?>" />
            <br/><label>Порядок</label><input type="text" name="order" id="order" placeholder="order" value="<?php echo $_POST['order'] ?>"/>
        </form>
        <script>
            function eatFood() {
                document.getElementById("form_id").submit();
            }
        </script>           
    </div>

</body>
</html>