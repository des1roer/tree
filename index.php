<?php include 'config.php'; ?>
<?php include 'db.php'; ?>
<body> 
    <?php
    if (isset($_POST))
    {
        $type = $_POST['type'];
        $id = $_POST["id"];
        $name = $_POST["name"];
        $link = $_POST["link"];
        $parent = $_POST["parent_id"];
        $order = $_POST["order"];
        if ($type == 'upd')
        {
            echo 'upd';
            $result = $db->query("UPDATE 
                                            page
                                          SET 
                                            title = '$name',
                                            link = '$link',
                                            parent_id = $parent,
                                            f_order = $order
                                          WHERE 
                                            id = $id;");
        }
        elseif ($type == 'add')
        {
            echo 'add';

            $result = $db->query("INSERT INTO 
                                          page
                                        (  
                                          title,
                                          link,
                                          parent_id,
                                          f_order
                                        ) 
                                      VALUES (
                                        '$name',
                                        '$link',
                                        $id,
                                        $order
                                      );");
        }
        elseif ($type == 'del')
        {
            echo 'del';
            $result = $db->query("DELETE FROM 
                                        page
                                      WHERE 
                                        id = $id;");
        }
    }
    ?>
    <?php var_dump($_POST); ?>
    <h2>Меню</h2>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree" data-options="
            url: 'ajax.php',
            method: 'get',
            animate: true,

            onClick: function(node){
            //	alert(node.parent);  // alert node text property when clicked
            },

            formatter:function(node){
            var s = node.text;
            if (node.children){
            s += '&nbsp;<span style=\'color:blue\'>(' + node.children.length + ')</span>';
            }
            return s;
            },
            onContextMenu: function(e,node){
            e.preventDefault();
            $(this).tree('select',node.target);
            $('#mm').menu('show',{
            left: e.pageX,
            top: e.pageY
            });
            },

            "></ul>
    </div>
    <div id="mm" class="easyui-menu" style="width:120px;">
        <!--     <div onclick="append()" data-options="iconCls:'icon-add'">Append</div> -->
        <!-- <div onclick="$('#w').window('open')" data-options="iconCls:'icon-add'">Append</div> -->
        <div onclick="add('add')" data-options="iconCls:'icon-add'">Добавить</div> 
        <div onclick="add('upd')" data-options="iconCls:'icon-edit'">Обновить</div> 
        <div onclick="add('del')" data-options="iconCls:'icon-remove'">Удалить</div> 
        <div class="menu-sep"></div>
        <div onclick="expand()">Expand</div>
        <div onclick="collapse()">Collapse</div>

    </div>
    <script type="text/javascript">
        function add(upd) {
            var t = $('#tt');
            var node = t.tree('getSelected');

            $.ajax({
                type: 'POST',
                url: 'modal.php',
                data: 'id=' + node.id + '&parent=' + node.parent + '&link=' + node.link + '&name=' + node.text + '&order=' + node.order + '&upd=' + upd,
                success: function (data) {
                    $('#dlg').html(data);
                },
                error: function (data) { // if error occured
                    alert("Error occured.please try again");
                    alert(data);
                },
                dataType: 'html'
            });

        }
        function append() {
            var t = $('#tt');
            var node = t.tree('getSelected');
            t.tree('append', {
                parent: (node ? node.target : null),
                data: [{
                        text: 'new item1'
                    }, {
                        text: 'new item2'
                    }]
            });
        }
        function removeit() {
            var node = $('#tt').tree('getSelected');
            $('#tt').tree('remove', node.target);
        }
        function collapse() {
            var node = $('#tt').tree('getSelected');
            $('#tt').tree('collapse', node.target);
        }
        function expand() {
            var node = $('#tt').tree('getSelected');
            $('#tt').tree('expand', node.target);
        }
        /* $(document).ready(function () {
         $('#dlg').dialog('close');
         });*/
    </script>


    <div id="dlg" style="display:none">		

    </div>
</body>
</html>